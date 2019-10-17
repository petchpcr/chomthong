<?PHP
extract($_GET);
$sql = "SELECT * FROM tb_dorm_room a INNER JOIN tb_dorm b ON a.dorm_id = b.dorm_id WHERE dorm_room_id = {$id}";
$row = row_array($sql);

$sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$id}' AND roomer_status < 5";
$cc = result_array($sql);
$count_pp = count($cc);
?>

<h5 class="text-center">ห้อง <?= $row['dorm_room_name']; ?> มีผู้เข้าพัก</h5>
<table class="table">
  <tr>
    <th class="text-center" width="100">รหัส</th>
    <th class="text-center">ชื่อ-นามสกุล</th>
    <th class="text-center" width="100">สถานะ</th>
  </tr>
  <?PHP foreach ($cc as $_cc) { ?>
    <?PHP
      $user = get_text_user_id($_cc['renter_id']);
      ?>
    <tr>
      <td class="text-center"><?= $user['code']; ?></td>
      <td><?= $user['name']; ?> <?= $user['lastname']; ?></td>
      <td class="text-center"><?= roomer_status($_cc['roomer_status']) ?></td>
    </tr>
  <?PHP } ?>

  <?PHP if ($count_pp == 0) { ?>
    <tr style="background: #ffc6b5;">
      <th class="text-center" colspan="3">ไม่มีผู้เข้าพัก</th>
    </tr>
  <?PHP } ?>
</table>

<hr>
<?PHP if ($count_pp > 0) { ?>

  <h5 class="text-center">ประจำเดือน <?= month_name($mm) ?> <?= $yy ?></h5>

  <?PHP
    $dorm_payment_month = $mm;
    $dorm_payment_year = $yy;

    $dorm_payment_id = "";

    $dorm_payment_price = $row['dorm_price'];
    $dorm_payment_electric = "";
    $dorm_payment_water = "";
    $dorm_payment_other = "";
    $dorm_payment_msg = "";


    if (isset($_GET['dorm_payment_id'])) {

      $dorm_payment_id = $_GET['dorm_payment_id'];

      $sql = "SELECT * FROM tb_dorm_payment WHERE dorm_payment_id = {$dorm_payment_id}";
      $row = row_array($sql);

      $dorm_payment_price = $row['dorm_payment_price'];
      $dorm_payment_electric = $row['dorm_payment_electric'];
      $dorm_payment_water = $row['dorm_payment_water'];
      $dorm_payment_other = $row['dorm_payment_other'];
      $dorm_payment_msg = $row['dorm_payment_msg'];
    }
    ?>

  <form action="process/dorm_payment_process.php" method="post" enctype="multipart/form-data" class="row">
    <input type="hidden" name="dorm_payment_id" value="<?= $dorm_payment_id ?>">
    <input type="hidden" name="dorm_room_id" value="<?= $id; ?>">
    <input type="hidden" name="dorm_payment_year" value="<?= $dorm_payment_year; ?>">
    <input type="hidden" name="dorm_payment_month" value="<?= $dorm_payment_month; ?>">

    <div class="col-md-6">
      <div class="form-group">
        <label>ค่าห้อง :</label>
        <input type="text" class="form-control numberOnly" name="dorm_payment_price" value="<?= $dorm_payment_price; ?>" readonly>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>ค่าไฟ :</label>
        <input type="text" class="form-control numberOnly" name="dorm_payment_electric" value="<?= $dorm_payment_electric; ?>" required>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>ค่าน้ำ :</label>
        <input type="text" class="form-control numberOnly" name="dorm_payment_water" value="<?= $dorm_payment_water; ?>" required>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>ค่าอื่นๆ :</label>
        <input type="text" class="form-control numberOnly" name="dorm_payment_other" value="<?= $dorm_payment_other; ?>" required>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label>หมายเหตุ :</label>
        <textarea name="dorm_payment_msg" class="form-control" required><?= $dorm_payment_msg; ?></textarea>
      </div>
    </div>

    <div class="col-md-12 text-text">
      <center>
        <button type="submit" class="btn btn-primary btn-lg">บันทึก</button>
      </center>
    </div>
  </form>

<?PHP } ?>