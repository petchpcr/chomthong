<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>
    
    <div class="text-center" style="display: block">
      <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
        <i class="fas fa-archive"></i>
      </div>
    </div>
    <h1 class="text-center text-truncate h3 mb-4">อนุมัติการยืมครุภัณฑ์</h1>

    <div class="row d-flex justify-content-center">
      <div class="col-md-8 col-md-offset-2">

        <?PHP
        $sql = "SELECT * FROM tb_equipment_lend z inner join tb_equipment a on z.equipment_id = a.equipment_id inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where equipment_lend_status = 0 order by equipment_lend_status asc";
        $list = result_array($sql);
        ?>

        <?PHP foreach ($list as $key => $_list) { ?>

          <div class="list-single">
            <div class="row">
              <div class="col-md-3">
                <img src="uploads/<?= $_list['equipment_picture']; ?>" class="img-responsive" alt="">
              </div>

              <div class="col-md-6">
                <h2><?= $_list['equipment_name']; ?></h2>
                <p>
                  <b>รหัสครุภัณฑ์ : </b> <?= $_list['equipment_code']; ?>
                </p>
                <p>
                  <b>รายละเอียด : </b> <?= $_list['equipment_lend_objective']; ?>
                </p>

                <p>
                  <b>ประเภท : </b> <?= $_list['equipment_category']; ?>
                </p>

                <p>
                  <b>หมวดหมู่ : </b> <?= $_list['equipment_type']; ?>
                </p>
                <p>
                  <b>ผู้ยืม : </b>
                  <?php
                    $user = get_text_user_id($_list['lender_id']);
                    ?>
                  [ <?= status($user['status']); ?> ] <?= $user['name']; ?> <?= $user['lastname']; ?>
                </p>
                <p>
                  <b>วันที่ยืม : </b> <?= $_list['equipment_lend_date_start']; ?>
                </p>

                <p>
                  <b>วันที่คืน : </b> <?= $_list['equipment_lend_date_return']; ?>
                </p>
              </div>
              <div class="col-md-3">

                <?PHP if ($_list['equipment_lend_status'] == 0) { ?>
                  <a href="process/update_equipment_lend.php?status=1&id=<?= $_list['equipment_lend_id']; ?>" class="btn btn-sm btn-success" style="width: 100%; margin-top: 15px;" onclick="return confirm('ยืนยันการอนุมัติ?');">
                    <i class="fa fa-check"></i> อนุมัติ
                  </a>

                  <a href="process/update_equipment_lend.php?status=8&id=<?= $_list['equipment_lend_id']; ?>" class="btn btn-sm btn-danger" style="width: 100%; margin-top: 15px;" onclick="return confirm('ยืนยันการไม่อนุมัติ?');">
                    <i class="fa fa-times"></i> ไม่อนุมัติ
                  </a>
                <?PHP } ?>
              </div>
            </div>
          </div>
        <?PHP } ?>

      </div>
    </div>


  </div>

</div>