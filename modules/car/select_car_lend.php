<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <?PHP
  $where = "";
  $search_car_type = 0;
  //    $date_start = date("Y-m-d");
  //    $date_end = date('Y-m-d', strtotime('+1 day', strtotime($date_start)));
  //    $time_start = date("H:i");
  //    $time_end = date("H:i");

  $date_start = "";
  $date_end = "";
  $time_start = "";
  $time_end = "";

  if (isset($_GET['search_car_type'])) {
    $search_car_type = $_GET['search_car_type'];
  }

  if (isset($_GET['date_start'])) {
    $date_start = $_GET['date_start'];
  }

  if (isset($_GET['date_end'])) {
    $date_end = $_GET['date_end'];
  }

  if (isset($_GET['time_start'])) {
    $time_start = $_GET['time_start'];
  }

  if (isset($_GET['time_end'])) {
    $time_end = $_GET['time_end'];
  }

  if ($search_car_type > 0) {
    $where .= " AND car_type_id = '{$search_car_type}'";
  }



  ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-car"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3">จองรถ</h1>
      <div class="text-center mb-4">
        <small style="color: #ff0000">กรุณาเลือกวันเวลาที่ต้องการจองรถ</small>
      </div>
      <div class="row">

        <div class="col-lg-12">
          <hr>

          <form action="">
            <input type="hidden" name="module" value="car">
            <input type="hidden" name="action" value="select_car_lend">
            <div class="row">
              <div class="col-md-3">
                <label for="">วันที่เริ่มต้น</label>
                <input type="date" name="date_start" value="<?= $date_start ?>" class="form-control" placeholder="วันที่เริ่ม">
              </div>
              <div class="col-md-3">
                <label for="">เวลาเริ่ม</label>
                <input type="time" name="time_start" value="<?= $time_start ?>" class="form-control" placeholder="เวลาเริ่ม">
              </div>
              <div class="col-md-3">
                <label for="">วันที่สิ้นสุด</label>
                <input type="date" name="date_end" value="<?= $date_end ?>" class="form-control" placeholder="วันที่เริ่ม">
              </div>
              <div class="col-md-3">
                <label for="">เวลาสิ้นสุด</label>
                <input type="time" name="time_end" value="<?= $time_end ?>" class="form-control" placeholder="เวลาสิ้นสุด">
              </div>
            </div>
            <div class="row d-flex justify-content-center">
              <div class="col-md-4 col-md-offset-3">
                <label for="">ประเภทรถ</label>
                <select name="search_car_type" class="form-control">
                  <option value="0">ทุกประเภท</option>
                  <?PHP
                  $sql = "SELECT * FROM tb_car_type";
                  $car = result_array($sql);
                  ?>
                  <?PHP foreach ($car as $_car) { ?>
                    <option <?= $search_car_type == $_car['car_type_id'] ? "selected" : "" ?> value="<?= $_car['car_type_id']; ?>">
                      <?= $_car['car_type_name']; ?>
                    </option>
                  <?PHP } ?>
                </select>
              </div>
              <div class="col-md-2">
                <label for=""></label>
                <button type="submit" class="btn btn-sm btn-primary" style="width: 100%; margin-top: 5px">
                  ค้นหา
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <hr>
      <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-9">


          <?PHP if ($date_start != "" && $time_start != "" && $date_end != "" && $time_end != "") { ?>


            <?PHP
              check_datetime_booking_car($date_start, $date_end, $time_start, $time_end);

              $sql = "SELECT * FROM tb_car where delete_data = 0 {$where}";
              $list = result_array($sql);
              ?>

            <?PHP foreach ($list as $key => $_list) { ?>

              <?PHP
                  $status = check_car_lend($_list['car_id'], $date_start, $date_end, $time_start, $time_end);
                  ?>

              <div class="list-single">
                <div class="row">
                  <div class="col-md-3">
                    <img src="uploads/<?= $_list['car_picture']; ?>" class="img-responsive" alt="">
                  </div>

                  <div class="col-md-7">
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
                  </div>
                  <div class="col-md-2">
                    <?PHP
                        $css_color_car = $status == 0 ? "#468548" : "#ff0000";
                        ?>
                    <p class="car-status" style="color: <?= $css_color_car; ?>;">
                      <?= car_status($status); ?>
                    </p>

                    <?PHP if ($status == 0) { ?>
                      <a data-remote="false" data-toggle="modal" data-target="#hrefModal" style="width: 100%; margin-top: 10px" href="index.php?module=modal&action=car/car_land_form&id=<?= $_list['car_id']; ?>&date_start=<?= $date_start; ?>&date_end=<?= $date_end; ?>&time_start=<?= $time_start; ?>&time_end=<?= $time_end; ?>" class="btn btn-sm btn-success btn-rounded">
                        <i class="fa fa-pencil-square"></i> จองเลย
                      </a>
                    <?PHP } ?>
                  </div>
                </div>
              </div>
            <?PHP } ?>

          <?PHP } ?>
        </div>
      </div>


    </div>
  </div>

</div>