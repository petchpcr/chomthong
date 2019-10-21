<?PHP
extract($_GET);
$sql = "SELECT * FROM tb_car where car_id = '{$id}'";
$row = row_array($sql);

?>

<form action="process/car_lend_process.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="car_id" value="<?= $id ?>">

  <div class="list-single row">
    <div class="col-md-4">
      <img src="uploads/<?= $row['car_picture']; ?>" class="img-responsive" alt="">
    </div>

    <div class="col-md-8">
      <h3><?= $row['car_brand']; ?> <?= $row['car_model']; ?></h3>
      <p>
        <b>ประเภท : </b> <?= get_car_type_name($row['car_type_id']); ?>
      </p>
      <p>
        <b>สี : </b> <?= $row['car_color']; ?>
      </p>
      <p>
        <b>ป้ายทะเบียน : </b> <?= $row['car_licence']; ?>
      </p>
      <p>
        <b>จำนวนที่นั่ง : </b> <?= $row['car_sit']; ?>
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>สถานที่ :</label>
        <input type="text" class="form-control" name="car_lend_place" required>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label>วัตถุประสงค์ :</label>
        <textarea name="car_lend_objective" class="form-control" required></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>วันที่เริ่มต้น :</label>
        <input type="date" class="form-control" name="car_lend_starttime" value="<?= $date_start; ?>" readonly>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>วันที่สิ้นสุด :</label>
        <input type="date" class="form-control" name="car_lend_endtime" value="<?= $date_end; ?>" readonly>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>เวลาเริ่มต้น :</label>
        <input type="time" class="form-control" name="time_start" value="<?= $time_start ?>" readonly>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>เวลาสิ้นสุด :</label>
        <input type="time" class="form-control" name="time_end" value="<?= $time_end; ?>" readonly>
      </div>
    </div>


    <div class="col-md-6">
      <div class="form-group">
        <label>คนขับรถ :</label>
        <select name="driver_id" class="form-control" required>
          <option disabled selected value="">เลือกคนขับ</option>
          <?PHP
          $sql = "SELECT * FROM tb_driver where delete_data = 0";
          $driver = result_array($sql);
          ?>
          <?PHP foreach ($driver as $_driver) { ?>
            <?PHP
              $disabled = "";
              $disabled_text = "";
              $status = check_driver_car_lend($_driver['driver_id'], $date_start, $date_end, $time_start, $time_end);
              if ($status) {
                $disabled = "disabled";
                $disabled_text = "(ไม่ว่าง)";
              }

              ?>
            <option <?= $disabled; ?> value="<?= $_driver['driver_id']; ?>">
              <?= $_driver['driver_name']; ?>
              <?= $_driver['driver_lastname']; ?> <?= $disabled_text; ?>
            </option>
          <?PHP } ?>
        </select>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>จำนวนผู้โดยสาร :</label>
        <select name="car_lend_people" class="form-control" required>
          <option disabled selected value="">เลือกจำนวนผู้โดยสาร</option>
          <?PHP for ($p = 1; $p <= $row['car_sit']; $p++) { ?>
            <option value="<?= $p ?>"><?= $p ?> ท่าน</option>
          <?PHP } ?>
        </select>
      </div>
    </div>

    <?PHP
    $Title = "ยืนยันการจอง";
    $Text = "เมื่อจองแล้วไม่สามารถแก้ไข หรือยกเลิกการจองได้ ?";
    $Color = "#d33";
    $Name = "carlend";
    ?>
    <button type="submit" id="smt_carlend" hidden></button>
    
  </div>
</form>
<div class="col-md-12 text-right">
  <button onclick="AlertConSubmit('<?= $Title; ?>', '<?= $Text; ?>', '<?= $Color; ?>', '<?= $Name; ?>')" class="btn btn-primary">ยืนยันการจอง</button>
</div>