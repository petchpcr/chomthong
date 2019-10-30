<?PHP
if ($_SESSION['title'] == 'นาย') {
  $gender = 1;
  $dorm_gender = "OR dorm_gender = ".$gender;
} else if ($_SESSION['title'] == 'นาง' || $_SESSION['title'] == 'นางสาว') {
  $gender = 2;
  $dorm_gender = "OR dorm_gender = ".$gender;
}
?>
<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-home"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">จองห้องพัก</h1>

      <div class="row d-flex justify-content-center">

        <div class="col-md-8 col-md-offset-2">

          <?PHP
          $sql = "SELECT * FROM tb_setting where setting_id = 1";
          $row = row_array($sql);
          ?>


          <?PHP if ($row['setting_value'] == 1) { ?>

            <?PHP
              $position = 1;
              if (check_session('status') == 0) {
                $position = 0;
              }

              $sql = "SELECT * FROM tb_dorm WHERE delete_data = 0 AND dorm_position = '{$position}' AND (dorm_gender = 0 ".$dorm_gender.")";
              $list = result_array($sql);
              ?>

            <?PHP foreach ($list as $key => $_list) { ?>

              <div class="list-single">
                <div class="row">
                  <div class="col-md-3">
                    <img src="uploads/<?= $_list['dorm_picture']; ?>" class="img-responsive" alt="">
                  </div>

                  <div class="col-md-6">
                    <h2><?= $_list['dorm_name']; ?></h2>
                    <p>
                      <b>ราคา : </b> <?= number_format($_list['dorm_price']); ?>
                    </p>
                    <p>
                      <b>รายละเอียด : </b> <?= $_list['dorm_detail']; ?>
                    </p>
                    <p>
                      <b>สิทธิการเข้าพัก : </b> <?= dorm_position($_list['dorm_position']); ?>
                    </p>
                    <p>
                      <b>ประเภท : </b> <?= dorm_gender($_list['dorm_gender']); ?>
                    </p>
                  </div>
                  <div class="col-md-3">

                    <?PHP
                        $renter_id = check_session('id');
                        $sql = "SELECT * FROM tb_roomer a 
                                inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id 
                                inner join tb_dorm d on b.dorm_id = d.dorm_id 
                                where renter_id = '{$renter_id}' 
                                and a.roomer_status BETWEEN 1 AND 4";
                        $check = row_array($sql);
                        ?>

                    <?PHP if (!$check) { ?>

                      <a style="width: 100%; margin-top: 10px" href="index.php?module=dorm&action=booking_dorm_room&dorm_id=<?= $_list['dorm_id']; ?>" class="btn btn-info">จองห้องพัก</a>

                    <?PHP } ?>

                  </div>
                </div>
              </div>
            <?PHP } ?>

          <?PHP } else { ?>
            <p style="color: #ff0000; text-align: center; font-size: 30px; padding: 30px 0;">
              ระบบการจองห้องพักถูกปิดอยู่
            </p>
          <?PHP } ?>


        </div>
      </div>
    </div>
  </div>


</div>
</div>

</div>