<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">
    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-graduation-cap"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">จัดการหลักสูตร</h1>

      <div class="row">
        <div class="col-lg-12">
          <div class="text-right mb-3">
            <a href="index.php?module=modal&action=major/major_form" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
              <i class="fa fa-plus"></i>
              เพิ่มข้อมูล</a>
          </div>

          <?PHP
          $sql = "SELECT * FROM tb_major where delete_data = 0";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <th width="120" class="text-center">รหัสหลักสูตร</th>
                  <th class="text-center">ชื่อ</th>
                  <th class="text-center">คณะ</th>
                  <th class="text-center">ระดับ</th>
                  <th width="80" class="text-center">หลักสูตร</th>
                  <th width="50" class="text-center">แก้ไข</th>
                  <th width="50" class="text-center">ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { ?>
                  <tr>
                    <td class="text-center"><?= $_list['major_id']; ?></td>
                    <td class="text-center"><?= $_list['major_name']; ?></td>
                    <td class="text-center"><?= $_list['major_faculty']; ?></td>
                    <td class="text-center"><?= $_list['major_degree']; ?></td>
                    <td class="text-center"><?= $_list['major_course']; ?> ปี</td>
                    <td class="text-center">
                      <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=major/major_form&id=<?= $_list['major_id']; ?>" class="btn btn-sm btn-warning btn-rounded">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
                    <td class="text-center">
                      <a href="process/delete.php?table=tb_major&ff=major_id&id=<?= $_list['major_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบ?');">
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