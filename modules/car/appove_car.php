<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-car"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">อนุมัติการจอง</h1>

      <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">

          <?PHP
          $sql = "SELECT * FROM tb_car_lend a 
                  inner join tb_car b on a.car_id = b.car_id 
                  inner join tb_driver d on a.driver_id = d.driver_id 
                  where car_lend_status = 0 
                  order by car_lend_starttime asc , a.car_id asc";
          $list = result_array($sql);
          ?>

          <?PHP foreach ($list as $key => $_list) { ?>

            <div class="list-single">
              <div class="row">
                <div class="col-md-3">
                  <img src="uploads/<?= $_list['car_picture']; ?>" class="img-responsive" alt="">
                </div>

                <div class="col-md-6">
                  <h2><?= $_list['car_brand']; ?> <?= $_list['car_model']; ?></h2>
                  <p>
                    <b>ประเภท : </b> <?= get_car_type_name($_list['car_type_id']); ?>
                  </p>
                  <p>
                    <b>สี : </b> <?= $_list['car_color']; ?>
                  </p>
                  <p>
                    <b>ป้ายทะเบียน : </b> <?= $_list['car_licence']; ?>
                  </p>
                  <p>
                    <b>จำนวนที่นั่ง : </b> <?= $_list['car_sit']; ?>
                  </p>
                  <p>
                    <b>สถานที่ : </b> <?= $_list['car_lend_place']; ?>
                  </p>
                  <p>
                    <b>วัตถุประสงค์ : </b> <?= $_list['car_lend_objective']; ?>
                  </p>
                  <p>
                    <b>วันที่ยืม : </b> <?= $_list['car_lend_starttime']; ?>
                  </p>
                  <p>
                    <b>วันที่คืน : </b> <?= $_list['car_lend_endtime']; ?>
                  </p>
                </div>
                <div class="col-md-3">
                  <a href="modules/print/print_car_lend.php?car_lend_id=<?= $_list['car_lend_id'] ?>" style="width: 100%; margin-top: 15px;" target="_blank" class="btn btn-sm btn-primary">
                    <i class="fa fa-eye"></i> รายละเอียด
                  </a>

                  <?PHP if ($_list['car_lend_status'] == 0) { ?>
                    <a href="process/update_car_lend.php?status=1&id=<?= $_list['car_lend_id']; ?>" class="btn btn-sm btn-success" style="width: 100%; margin-top: 15px;" onclick="return confirm('ยืนยันการอนุมัติ?');">
                      <i class="fa fa-check"></i> อนุมัติ
                    </a>

                    <a href="process/update_car_lend.php?status=8&id=<?= $_list['car_lend_id']; ?>" class="btn btn-sm btn-danger" style="width: 100%; margin-top: 15px;" onclick="return confirm('ยืนยันการไม่อนุมัติ?');">
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
</div>

</div>