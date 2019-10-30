<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <?PHP
    //        $date_start = date("Y-m-d");
    //        $date_end = date('Y-m-d', strtotime('+1 day', strtotime($date_start)));
    //        $time_start = date("H:i");
    //        $time_end = date("H:i");

    $date_start = "";
    $date_end = "";
    $time_start = "";
    $time_end = "";


    if (isset($_GET['date_start'])) {
      $date_start = $_GET['date_start'];
    }

    if (isset($_GET['date_end'])) {
      $date_end = $_GET['date_end'];
    }

    if (isset($_GET['time_start'])) {
      $time_start = $_GET['time_start'];
    }

    if (isset($_GET['time_end'])) {
      $time_end = $_GET['time_end'];
    }


    ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-archive"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3">ยืมครุภัณฑ์</h1>
      <div class="text-center mb-4">
        <small style="color: #ff0000;">กรุณาเลือกวันเวลาที่ต้องการยืมครุภัณฑ์</small>
      </div>
      <div class="row">
        <div class="col-lg-12">

          <hr>

          <form action="">
            <input type="hidden" name="module" value="equipment">
            <input type="hidden" name="action" value="list_equipment_lend">
            <div class="row">
              <div class="col-md-3">
                <label for="">วันที่เริ่มต้น</label>
                <input type="date" name="date_start" value="<?= $date_start ?>" class="form-control" placeholder="วันที่เริ่ม">
              </div>
              <div class="col-md-2">
                <label for="">เวลาเริ่ม</label>
                <input type="time" name="time_start" value="<?= $time_start ?>" class="form-control" placeholder="เวลาเริ่ม">
              </div>
              <div class="col-md-3">
                <label for="">วันที่สิ้นสุด</label>
                <input type="date" name="date_end" value="<?= $date_end ?>" class="form-control" placeholder="วันที่เริ่ม">
              </div>
              <div class="col-md-2">
                <label for="">เวลาสิ้นสุด</label>
                <input type="time" name="time_end" value="<?= $time_end ?>" class="form-control" placeholder="เวลาสิ้นสุด">
              </div>
              <div class="col-md-2">
                <label for=""></label>
                <button type="submit" class="btn btn-sm btn-primary" style="width: 100%; margin-top: 5px">
                  ค้นหา
                </button>
              </div>
            </div>
          </form>

          <hr>

          <?PHP if ($date_start != "" && $time_start != "" && $date_end != "" && $time_end != "") { ?>
            <?PHP
              check_datetime_booking_equipment($date_start, $date_end, $time_start, $time_end);

              $sql = "SELECT * FROM tb_equipment a inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where a.delete_data = 0";
              $list = result_array($sql);
              ?>
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="table-js">
                <thead>
                  <tr>
                    <th width="50" class="text-center">รูป</th>
                    <th class="text-center">รหัส</th>
                    <th class="text-center">รายการ</th>
                    <th class="text-center">หมวดหมู่</th>
                    <th class="text-center">อาคาร / ห้อง</th>
                    <th width="120" class="text-center">สถานะ</th>
                    <th width="120" class="text-center">รายละเอียด</th>
                    <th width="100" class="text-center">ยืมครุภัณฑ์</th>
                  </tr>
                </thead>
                <tbody>
                  <?PHP foreach ($list as $key => $_list) { ?>

                    <?PHP
                        $status = check_equipment_lend($_list['equipment_id'], $date_start, $date_end, $time_start, $time_end);
                        ?>

                    <tr>
                      <td class="text-center">
                        <img src="uploads/<?= $_list['equipment_picture']; ?>" class="img-responsive" alt="">
                      </td>
                      <td class="text-center"><?= $_list['equipment_code']; ?></td>
                      <td class="text-center"><?= $_list['equipment_name']; ?></td>
                      <td class="text-center"><?= $_list['equipment_type']; ?></td>
                      <td class="text-center"><?= $_list['building_name']; ?>
                        / <?= $_list['building_room_name']; ?></td>
                      <td class="text-center">
                        <?= equipment_status($status); ?>
                      </td>
                      <td class="text-center">
                        <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=equipment/row_equipment_lend_detail&equipment_id=<?= $_list['equipment_id']; ?>" class="btn btn-sm btn-primary btn-rounded">
                          รายละเอียด
                        </a>
                      </td>
                      <td class="text-center">
                        <?PHP if ($status == 0) { ?>
                          <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=equipment/equipment_lend_form&equipment_id=<?= $_list['equipment_id']; ?>&date_start=<?= $date_start; ?>&date_end=<?= $date_end; ?>&time_start=<?= $time_start; ?>&time_end=<?= $time_end; ?>" class="btn btn-sm btn-success btn-rounded">
                            ยืม
                          </a>
                        <?PHP } ?>
                      </td>
                    </tr>
                  <?PHP } ?>
                </tbody>
              </table>
            </div>

          <?PHP } ?>

        </div>
      </div>


    </div>
  </div>

</div>