<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-user"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">จัดการอาจารย์</h1>

      <div class="row">
        <div class="col-lg-12">
          <div class="text-right mb-3">
            <a href="index.php?module=modal&action=user/teacher_form" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
              <i class="fa fa-plus"></i>
              เพิ่มข้อมูล</a>
          </div>



          <?PHP
          $sql = "SELECT * FROM tb_teacher where delete_data = 0";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <!-- <th width="50" class="text-center">ลำดับ</th> -->
                  <th width="60" class="text-center">รูปภาพ</th>
                  <th class="text-center">ชื่อ-นามสกุล</th>
                  <th class="text-center">E-mail</th>
                  <th class="text-center">เบอร์โทร</th>
                  <th class="text-center">User</th>
                  <th width="50" class="text-center">แก้ไข</th>
                  <th width="50" class="text-center">ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { ?>
                  <tr>
                    <!-- <td class="text-center"><?= $key + 1; ?></td> -->
                    <td class="text-center">
                      <img src="uploads/<?= $_list['teacher_picture']; ?>" style="width: auto; height: 50px;" alt="">
                    </td>
                    <td class="text-center"><?= $_list['teacher_title']; ?><?= $_list['teacher_name']; ?> <?= $_list['teacher_lastname']; ?></td>
                    <td class="text-center"><?= $_list['teacher_email']; ?></td>
                    <td class="text-center"><?= $_list['teacher_telephone']; ?></td>
                    <td class="text-center"><?= $_list['teacher_user']; ?></td>
                    <td class="text-center">
                      <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=user/teacher_form&id=<?= $_list['teacher_id']; ?>" class="btn btn-sm btn-warning btn-rounded">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
                    <td class="text-center">
                      <a href="process/delete.php?table=tb_teacher&ff=teacher_id&id=<?= $_list['teacher_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบ?');">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                <?PHP } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
  </div>

</div>