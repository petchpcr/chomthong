<?PHP
$id = "";
$title = "";
$name = "";
$lastname = "";
$user = "";
$password = "";
$idcard = "";
$email = "";
$telephone = "";
$address = "";
$picture = "";
$position_id = 0;

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "SELECT * FROM tb_manager WHERE manager_id = {$id}";
  $row = row_array($sql);

  $title = $row['manager_title'];
  $name = $row['manager_name'];
  $lastname = $row['manager_lastname'];
  $user = $row['manager_user'];
  $password = $row['manager_password'];
  $idcard = $row['manager_idcard'];
  $email = $row['manager_email'];
  $telephone = $row['manager_telephone'];
  $address = $row['manager_address'];
  $picture = $row['manager_picture'];
  $position_id = $row['position_id'];
}

?>

<form action="process/manager_process.php" method="post" enctype="multipart/form-data" class="row d-flex justify-content-center">
  <input type="hidden" id="user_id" data-tb='manager' name="id" value="<?= $id ?>">
  <input type="hidden" name="position_id" value="<?= $position_id; ?>">


  <?PHP if ($picture != "") { ?>
    <div class="col-md-12 text-center">
      <img style="width: auto; height: 150px;" src="uploads/<?= $picture; ?>" alt="">

      <hr>
    </div>
  <?PHP } ?>

  <div class="col-md-12">
    <div class="form-group">
      <label>คำนำหน้าชื่อ :</label>
      <select name="title" id="" class="form-control">
        <option value="">ระบุคำนำหน้า</option>
        <option value="นาย" <?= $title == "นาย" ? "selected" : ""; ?>>นาย</option>
        <option value="นาง" <?= $title == "นาง" ? "selected" : ""; ?>>นาง</option>
        <option value="นางสาว" <?= $title == "นางสาว" ? "selected" : ""; ?>>นางสาว</option>
      </select>
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
      <label>User :</label>
      <input type="text" id="user_name" class="form-control" name="user" value="<?= $user; ?>" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>รหัสผ่าน :</label>
      <input type="password" class="form-control" name="password" value="<?= $password; ?>" required>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>เลขบัตรประชาชน :</label>
      <input type="text" class="form-control numberOnly" name="idcard" minlength="13" maxlength="13" value="<?= $idcard; ?>">
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>ตำแหน่ง</label>
      <?PHP
      $sql = "SELECT * FROM tb_position WHERE position_type = 'ผู้บริหาร'";
      $result = result_array($sql);
      ?>
      <select name="position_id" class="form-control">
        <!-- <option selected value="0">เลือกตำแหน่ง</option> -->
        <?PHP foreach ($result as $row) { ?>
          <option <?= $row['position_id'] == $position_id ? "selected" : ""; ?> value="<?= $row['position_id'] ?>"><?= $row['position_name'] ?></option>
        <?PHP } ?>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>E-mail :</label>
      <input type="emsil" class="form-control" name="email" value="<?= $email; ?>">
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>เบอร์โทร :</label>
      <input type="text" class="form-control numberOnly" name="telephone" maxlength="10" value="<?= $telephone; ?>">
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label>ที่อยู่ :</label>
      <textarea name="address" class="form-control"><?= $address; ?></textarea>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label>รูปภาพ :</label>
      <input type="file" name="picture">
    </div>
  </div>
  <button type="submit" id="btn_add_user" hidden></button>
</form>

<div class="col-md-12 text-right">
  <button onclick="check_have_user()" class="btn btn-primary">บันทึก</button>
</div>