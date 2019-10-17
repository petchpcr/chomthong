<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-wrench"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">แจ้งซ่อมสำเร็จ</h1>

      <div class="row">
        <div class="col-lg-12">

          <?PHP
          $sql = "SELECT * FROM tb_maintenance where maintenance_status = 3";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <th class="text-center">รายการ</th>
                  <th class="text-center">สถานที่</th>
                  <th class="text-center">สถานะ</th>
                  <th width="80" class="text-center">รายละเอียด</th>
                  <th width="60" class="text-center">สำเร็จ</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { ?>
                  <tr>
                    <td class="text-center"><?= $_list['maintenance_list']; ?></td>
                    <td class="text-center"><?= $_list['maintenance_place']; ?></td>
                    <td class="text-center"><?= maintenance_status($_list['maintenance_status']); ?></td>
                    <td class="text-center">
                      <a href="index.php?module=maintenance&action=maintenance_detail&id=<?= $_list['maintenance_id']; ?>" class="btn btn-primary btn-sm">รายละเอียด</a>
                    </td>
                    <td class="text-center">
                      <?PHP if ($_list['maintenance_status'] == 3) { ?>
                        <a href="process/update_maintenance.php?status=4&id=<?= $_list['maintenance_id']; ?>" class="btn btn-sm btn-success" onclick="return confirm('ยืนยันการแก้ไขปัญหาสำเร็จ?');">
                          <i class="fa fa-check"></i>
                        </a>
                      <?PHP } ?>
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