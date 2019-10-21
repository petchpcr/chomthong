<?PHP
$id = "";
$title = "นาย";
$name = "";
$lastname = "";
$idcard = "";
$telephone = "";
$address = "";
$picture = "";

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "SELECT * FROM tb_driver WHERE driver_id = {$id}";
  $row = row_array($sql);

  $title = $row['driver_title'];
  $name = $row['driver_name'];
  $lastname = $row['driver_lastname'];
  $idcard = $row['driver_idcard'];
  $telephone = $row['driver_telephone'];
  $address = $row['driver_address'];
  $picture = $row['driver_picture'];
}

?>

<form action="process/driver_process.php" method="post" enctype="multipart/form-data" class="row">
  <input type="hidden" name="id" value="<?= $id ?>">


  <?PHP if ($picture != "") { ?>
    <div class="col-md-12 text-center">
      <img style="width: auto; height: 150px;" src="uploads/<?= $picture; ?>" alt="">

      <hr>
    </div>
  <?PHP } ?>

  <div class="col-md-12">
    <div class="form-group-row">
      <label>คำนำหน้าชื่อ :</label>
      <label>
        <input type="radio" name="title" <?= $title == "นาย" ? "checked" : ""; ?> value="นาย">
        นาย
      </label>

      <label>
        <input type="radio" name="title" <?= $title == "นาง" ? "checked" : ""; ?> value="นาง">
        นาง
      </label>

      <label>
        <input type="radio" name="title" <?= $title == "นางสาว" ? "checked" : ""; ?> value="นางสาว">
        นางสาว
      </label>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>ชื่อ :</label>
      <input type="text" class="form-control" name="name" value="<?= $name; ?>" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>นามสกุล :</label>
      <input type="text" class="form-control" name="lastname" value="<?= $lastname; ?>" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>เลขบัตรประชาชน :</label>
      <input type="text" class="form-control numberOnly" name="idcard" minlength="13" maxlength="13" value="<?= $idcard; ?>" required>
    </div>
  </div>


  <div class="col-md-6">
    <div class="form-group">
      <label>เบอร์โทร :</label>
      <input type="text" class="form-control numberOnly" name="telephone" maxlength="10" value="<?= $telephone; ?>" required>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label>ที่อยู่ :</label>
      <textarea name="address" class="form-control" required><?= $address; ?></textarea>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label>รูปภาพ :</label>
      <input type="file" name="picture">
    </div>
  </div>
  <div class="col-md-12 text-right">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</form>