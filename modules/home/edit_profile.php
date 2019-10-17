<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <!-- <div id="page-wrapper"> -->
    <div class="container-fluid mb-4">
      <?PHP
      $user = get_text_user_id(check_session('id'));
      $id = $user['id'];
      $status = $user['status'];

      if ($status == 4) {

        $sql = "SELECT * FROM tb_admin WHERE admin_id = {$id}";
        $row = row_array($sql);

        $name = $row['admin_name'];
        $lastname = $row['admin_lastname'];
        $user = $row['admin_user'];
        $password = $row['admin_password'];
        $idcard = $row['admin_idcard'];
        $email = $row['admin_email'];
        $telephone = $row['admin_telephone'];
        $address = $row['admin_address'];
        $picture = $row['admin_picture'];
      } else if ($status == 3) {
        $sql = "SELECT * FROM tb_manager WHERE manager_id = {$id}";
        $row = row_array($sql);

        $name = $row['manager_name'];
        $lastname = $row['manager_lastname'];
        $user = $row['manager_user'];
        $password = $row['manager_password'];
        $idcard = $row['manager_idcard'];
        $email = $row['manager_email'];
        $telephone = $row['manager_telephone'];
        $address = $row['manager_address'];
        $picture = $row['manager_picture'];
      } else if ($status == 2) {
        $sql = "SELECT * FROM tb_teacher WHERE teacher_id = {$id}";
        $row = row_array($sql);

        $name = $row['teacher_name'];
        $lastname = $row['teacher_lastname'];
        $user = $row['teacher_user'];
        $password = $row['teacher_password'];
        $idcard = $row['teacher_idcard'];
        $email = $row['teacher_email'];
        $telephone = $row['teacher_telephone'];
        $address = $row['teacher_address'];
        $picture = $row['teacher_picture'];
      } else if ($status == 1) {
        $sql = "SELECT * FROM tb_personnel WHERE personnel_id = {$id}";
        $row = row_array($sql);

        $name = $row['personnel_name'];
        $lastname = $row['personnel_lastname'];
        $user = $row['personnel_user'];
        $password = $row['personnel_password'];
        $idcard = $row['personnel_idcard'];
        $email = $row['personnel_email'];
        $telephone = $row['personnel_telephone'];
        $address = $row['personnel_address'];
        $picture = $row['personnel_picture'];
      } else if ($status == 0) {
        $sql = "SELECT * FROM tb_student WHERE student_id = {$id}";
        $row = row_array($sql);

        $name = $row['student_name'];
        $lastname = $row['student_lastname'];
        $user = $row['student_user'];
        $password = $row['student_password'];
        $idcard = $row['student_idcard'];
        $email = $row['student_email'];
        $telephone = $row['student_telephone'];
        $address = $row['student_address'];
        $picture = $row['student_picture'];
      }
      ?>

      <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center mb-3">
          <i class="fas fa-user-edit mr-2" style="font-size:2rem;"></i>
          แก้ไขข้อมูลส่วนตัว
        </div>

        <form action="process/edit_profile_process.php" method="post" enctype="multipart/form-data" class="row d-flex justify-content-center">
          <input type="hidden" name="id" value="<?= $id ?>">
          <input type="hidden" name="status" value="<?= $status; ?>">


          <?PHP if ($picture != "") { ?>
            <div class="col-12 text-center">
              <img style="width: auto; height: 150px;" src="uploads/<?= $picture; ?>" alt="">

              <hr>
            </div>
          <?PHP } ?>

          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>ชื่อ :</label>
              <input type="text" class="form-control form-control-user" name="name" value="<?= $name; ?>" readonly>
            </div>
          </div>

          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>นามสกุล :</label>
              <input type="text" class="form-control" name="lastname" value="<?= $lastname; ?>" readonly>
            </div>
          </div>
          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>User :</label>
              <input type="text" class="form-control" name="user" value="<?= $user; ?>" readonly>
            </div>
          </div>

          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>รหัสผ่าน :</label>
              <input type="password" class="form-control" name="password" value="<?= $password; ?>" required>
            </div>
          </div>


          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>เลขบัตรประชาชน :</label>
              <input type="text" class="form-control" name="idcard" maxlength="13" value="<?= $idcard; ?>" readonly>
            </div>
          </div>

          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>E-mail :</label>
              <input type="emsil" class="form-control" name="email" value="<?= $email; ?>" required>
            </div>
          </div>

          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>เบอร์โทร :</label>
              <input type="text" class="form-control" name="telephone" maxlength="10" value="<?= $telephone; ?>" required>
            </div>
          </div>

          <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="form-group">
              <label>ที่อยู่ :</label>
              <textarea name="address" class="form-control" required><?= $address; ?></textarea>
            </div>
          </div>

          <div class="col-12 col-md-8 col-lg-12">
            <div class="form-group">
              <label>รูปภาพ :</label>
              <input type="file" name="picture">
            </div>
          </div>

          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary mr-5">บันทึก</button>
          </div>


        </form>

      </div>


    </div>

  </div>

</div>