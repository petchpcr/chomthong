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
      <h1 class="text-center text-truncate h3 mb-4">แจ้งซ่อม</h1>

      <div class="row">

        <div class="col-lg-12">
          <div class="text-right mb-3">
            <a href="index.php?module=maintenance&action=maintenance_form" class="btn btn-primary">
              <i class="fa fa-plus"></i>
              เพิ่มข้อมูล</a>
          </div>

          <?PHP
          $sql = "SELECT * FROM tb_maintenance order by maintenance_id desc ";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <th width="50" class="text-center">ลำดับ</th>
                  <th class="text-center">รายการ</th>
                  <th class="text-center">ผู้แจ้ง</th>
                  <th class="text-center">สถานะ</th>
                  <th width="90" class="text-center">รายละเอียด</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { ?>
                  <tr>
                    <td class="text-center"><?= $key+1; ?></td>
                    <td class="text-center"><?= $_list['maintenance_list']; ?></td>
                    <td class="text-center">
                      <?PHP
                        $user = get_text_user_id($_list['repairer_id']);
                        ?>
                      [ <?= status($user['status']); ?> ] <?= $user['name']; ?> <?= $user['lastname']; ?>
                    </td>
                    <td class="text-center"><?= maintenance_status($_list['maintenance_status']); ?></td>
                    <td class="text-center">
                      <a href="index.php?module=maintenance&action=maintenance_detail_list&id=<?= $_list['maintenance_id']; ?>" class="btn btn-primary btn-sm">รายละเอียด</a>
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