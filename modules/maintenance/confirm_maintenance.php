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
      <h1 class="text-center text-truncate h3 mb-4">รับเรื่องแจ้งซ่อม</h1>

      <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">

          <?PHP
          $sql = "SELECT * FROM tb_maintenance a inner join tb_maintenance_type b on a.maintenance_type_id = b.maintenance_type_id where maintenance_status = 0 order by maintenance_status asc  ";
          $list = result_array($sql);
          ?>

          <?PHP foreach ($list as $key => $_list) { ?>

            <div class="list-single">
              <div class="row">
                <div class="col-lg-4">
                  <?PHP
                    $sql = "SELECT * FROM tb_maintenance_img WHERE maintenance_id = '{$_list['maintenance_id']}'";
                    $photo = row_array($sql);
                    ?>

                  <?PHP if ($photo) { ?>
                    <img src="uploads/<?= $photo['maintenance_img_name']; ?>" class="img-responsive" alt="">
                  <?PHP } else { ?>
                    <img src="uploads/no.jpg" class="img-responsive" alt="">
                  <?PHP } ?>
                </div>
                <div class="col-lg-5">
                  <h3><?= $_list['maintenance_list']; ?></h3>
                  <p>
                    <b>ประเภท :</b>
                    <?= $_list['maintenance_type_name']; ?>
                  </p>
                  <p>
                    <b>รายละเอียด :</b>
                    <?= $_list['maintenance_detail']; ?>
                  </p>
                  <p>
                    <b>สถานที่ :</b>
                    <?= $_list['maintenance_place']; ?>
                  </p>
                  <p>
                    <b>ผู้แจ้ง :</b>
                    <?php
                      $user = get_text_user_id($_list['repairer_id']);
                      ?>
                    [ <?= status($user['status']); ?> ] <?= $user['name']; ?> <?= $user['lastname']; ?>
                  </p>
                  <p>
                    <b>หมายเหตุ :</b>
                    <?= $_list['maintenance_msg']; ?>
                  </p>
                </div>
                <div class="col-lg-3">
                  <a href="index.php?module=maintenance&action=maintenance_detail&id=<?= $_list['maintenance_id']; ?>" style="width: 100%; margin-top: 15px;" class="btn btn-primary">
                    <i class="fa fa-eye"></i> รายละเอียด
                  </a>

                  <a href="process/update_maintenance.php?status=1&id=<?= $_list['maintenance_id']; ?>" class="btn btn-success" style="width: 100%; margin-top: 15px;" onclick="return confirm('ยืนยันการรับเรื่อง?')">รับเรื่อง</a>
                  <a href="process/update_maintenance.php?status=8&id=<?= $_list['maintenance_id']; ?>" class="btn btn-danger" style="width: 100%; margin-top: 15px;" onclick="return confirm('ยืนยันการไม่อนุมัติ?')">ไม่อนุมัติ</a>
                </div>
              </div>
            </div>
          <?PHP } ?>

        </div>

      </div>


    </div>
  </div>

</div>