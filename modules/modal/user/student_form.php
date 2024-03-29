<?PHP
$id = "";
$title = "";
$code = "";
$name = "";
$lastname = "";
$user = "";
$password = "";
$idcard = "";
$email = "";
$telephone = "";
$address = "";
$picture = "";
$major_id = "";

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "SELECT * FROM tb_student WHERE student_id = {$id}";
  $row = row_array($sql);

  $code = $row['student_code'];
  $title = $row['student_title'];
  $name = $row['student_name'];
  $lastname = $row['student_lastname'];
  $user = $row['student_user'];
  $password = $row['student_password'];
  $idcard = $row['student_idcard'];
  $email = $row['student_email'];
  $telephone = $row['student_telephone'];
  $address = $row['student_address'];
  $picture = $row['student_picture'];
  $major_id = $row['major_id'];
}

?>

<form action="process/student_process.php" method="post" enctype="multipart/form-data" class="row d-flex justify-content-center">
  <input type="hidden" id="user_id" data-tb='student' name="id" value="<?= $id ?>">

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
      <label>หลักสูตร</label>
      <?PHP
      $sql = "SELECT * FROM tb_major WHERE delete_data  = 0";
      $result = result_array($sql);
      ?>
      <select name="major_id" class="form-control">
        <option disabled selected value="">เลือกหลักสูตร</option>
        <?PHP foreach ($result as $row) { ?>
          <option <?= $row['major_id'] == $major_id ? "selected" : ""; ?> value="<?= $row['major_id'] ?>"><?= $row['major_name'] ?></option>
        <?PHP } ?>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label>รหัสนักศึกษา :</label>
      <input type="text" class="form-control" name="code" value="<?= $code; ?>">
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

  <div class="col-md-12">
    <div class="form-group">
      <label>เลขบัตรประชาชน :</label>
      <input type="text" class="form-control numberOnly" name="idcard" minlength="13" maxlength="13" value="<?= $idcard; ?>">
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