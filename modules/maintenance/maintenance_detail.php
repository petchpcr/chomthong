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
      <h1 class="text-center text-truncate h3 mb-4">รายละเอียดแจ้งซ่อม</h1>

      <?PHP
      extract($_GET);
      $sql = "SELECT * FROM tb_maintenance a inner join tb_maintenance_type b on a.maintenance_type_id = b.maintenance_type_id WHERE maintenance_id = '{$id}'";
      $row = row_array($sql);

      $sql = "SELECT * FROM tb_maintenance_img WHERE maintenance_id = '{$id}'";
      $photo = result_array($sql);
      ?>

      <div class="row d-flex justify-content-center">

        <div class="col-md-8 col-md-offset-2">

          <?PHP foreach ($photo as $key => $p) { ?>
            <?PHP
              $style = 'style="width: 80px; height: 80px; float: left; padding: 0; margin: 5px;"';

              if ($key == 0) {
                $style = 'style="width: 80%; height: auto; margin:0 auto;"';
              }
              ?>
            <div class="thumbnail d-flex justify-content-center" <?= $style; ?>>
              <div class="caption">
                <span id="image<?= $key; ?>">
                  <a href="uploads/<?= $p['maintenance_img_name']; ?>" data-fancybox="photo">
                    <img src="uploads/<?= $p['maintenance_img_name']; ?>" style="width: auto; max-height: 350px;" />
                  </a>
                </span>
              </div>
            </div>
          <?PHP } ?>

          <?PHP if (count($photo) == 0) { ?>
            <div class="thumbnail d-flex justify-content-center" style="width: 80%; height: auto; margin:0 auto;">
              <div class="caption">
                <span id="image<?= $key; ?>">
                  <a href="uploads/<?= $p['maintenance_img_name']; ?>" data-fancybox="photo">
                    <img src="uploads/no.jpg" style="width: auto; height: 350px;" />
                  </a>
                </span>
              </div>
            </div>
          <?PHP } ?>
          <div class="clearfix"></div>

          <hr>
          <h4 class="text-center">รายละเอียดการแจ้ง</h4>
          <p>
            <b>ประเภท :</b>
            <?= $row['maintenance_type_name']; ?>
          </p>
          <p>
            <b>รายการ :</b>
            <?= $row['maintenance_list']; ?>
          </p>
          <p>
            <b>รายละเอียด :</b>
            <?= $row['maintenance_detail']; ?>
          </p>
          <p>
            <b>สถานที่ :</b>
            <?= $row['maintenance_place']; ?>

          </p>
          <p>
            <b>ผู้แจ้ง :</b>
            <?php
            $user = get_text_user_id($row['repairer_id']);
            ?>
            [ <?= status($user['status']); ?> ] <?= $user['name']; ?> <?= $user['lastname']; ?>
          </p>
          <p>
            <b>สถานะ :</b>
            <?= maintenance_status($row['maintenance_status']); ?>
          </p>

          <p>
            <b>หมายเหตุ :</b>
            <?= $row['maintenance_msg']; ?>
          </p>

          <?PHP if ($row['maintenance_price'] > 0 && $row['maintenance_pdf'] != "") { ?>

            <p>
              <b>งบประมาน :</b>
              <?= $row['maintenance_price']; ?> บาท
            </p>

            <p>
              <b>วันที่ส่งเรื่อง :</b>
              <?= $row['maintenance_date_send']; ?>

            </p>

            <p>
              <b>ผู้ส่งเรื่อง :</b>
              <?php
                $user = get_text_user_id($row['send_id']);
                ?>
              [ <?= status($user['status']); ?> ] <?= $user['name']; ?> <?= $user['lastname']; ?>
            </p>

            <?PHP if ($row['maintenance_pdf'] != "") { ?>
              <center>
                <a target="_blank" href="uploads/<?= $row['maintenance_pdf']; ?>" class="btn btn-primary btn-lg">
                  ดาวน์โหลดเอกสาร PDF
                </a>
              </center>

            <?PHP } ?>

          <?PHP } ?>
          <br>
          <br>
          <br>
        </div>
      </div>


    </div>
  </div>

</div>