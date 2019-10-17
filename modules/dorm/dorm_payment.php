<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="far fa-money-bill-alt"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">จัดการค่าใช้จ่าย</h1>

      <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">

          <?PHP
          $sql = "SELECT * FROM tb_dorm where delete_data = 0";
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
                </div>
                <div class="col-md-3">
                  <a style="width: 100%; margin-top: 10px" href="index.php?module=dorm&action=dorm_payment_room&dorm_id=<?= $_list['dorm_id']; ?>" class="btn btn-info">จัดการหอพักนี้</a>
                </div>
              </div>
            </div>
          <?PHP } ?>

        </div>
      </div>
    </div>


  </div>
</div>

</div>