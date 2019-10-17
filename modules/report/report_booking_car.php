<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-chart-bar"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">รายงาน</h1>

      <div class="row">

        <?PHP
        $start = date("Y-m-01");
        $end = date('Y-m-t', strtotime('today'));
        if (isset($_GET['start']) && isset($_GET['end'])) {
          $start = $_GET['start'];
          $end = $_GET['end'];
        }

        $Q_Type = " WHERE car_type_id = " . $_GET['Type'];
        if ($_GET['Type'] == null) {
          $Q_Type = "";
        }

        $sql = "SELECT * FROM tb_car_type";
        $list = result_array($sql);

        $sql = "SELECT car_id,car_licence FROM tb_car".$Q_Type;
        $car = result_array($sql);
        ?>

        <div class="col-lg-12">
          <hr>

          <div style="background: #fff; padding: 20px; min-height: 300px">
            <?PHP include 'include/menu_report.php'; ?>

            <div style="padding: 20px">
              <form action="" method="get">
                <input type="hidden" name="module" value="report">
                <input type="hidden" name="action" value="report_booking_car">

                <div class="row">
                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    ประเภทรถ
                    <select class="form-control" name="Type" id="slc_car_type" onchange="get_car_by_type()">
                      <option value="">ทุกประเภท</option>
                      <?PHP foreach ($list as $key => $_list) { ?>
                        <option value="<?= $_list['car_type_id']; ?>" <?= $_list['car_type_id'] == $_GET['Type'] ? "selected" : "" ?>><?= $_list['car_type_name']; ?></option>
                      <?PHP } ?>
                    </select>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    เลือกรถ
                    <select class="form-control" name="Car" id="slc_car">
                      <option value="">ทุกคัน</option>
                      <?PHP foreach ($car as $key => $_car) { ?>
                        <option value="<?= $_car['car_id']; ?>" <?= $_car['car_id'] == $_GET['Car'] ? "selected" : "" ?>><?= $_car['car_licence']; ?></option>
                      <?PHP } ?>
                    </select>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    วันที่
                    <input id="slc_car_start" type="date" name="start" value="<?= $start; ?>" class="form-control" required>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    ถึง
                    <div class="d-flex">
                      <input id="slc_car_end" type="date" name="end" value="<?= $end; ?>" class="form-control mr-2" required>
                      <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <hr>

              <?PHP
              $Q_Type = " AND b.car_type_id = " . $_GET['Type'];
              $Q_Car = " AND a.car_id = " . $_GET['Car'];
              if ($_GET['Type'] == null) {
                $Q_Type = "";
              }
              if ($_GET['Car'] == null) {
                $Q_Car = "";
              }

              $sql = "SELECT * FROM tb_car_lend a 
                      inner join tb_car b on a.car_id = b.car_id 
                      inner join tb_driver d on a.driver_id = d.driver_id 
                      where car_lend_status = 3 " . $Q_Type . $Q_Car . " 
                      AND DATE(car_lend_date) between '{$start}' and '{$end}' 
                      ORDER BY car_lend_starttime ASC";

              $list = result_array($sql);
              ?>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="50" class="text-center">ลำดับ</th>
                    <th class="text-center">ป้ายทะเบียน</th>
                    <th class="text-center">ประเภท</th>
                    <th class="text-center">สถานที่</th>
                    <th class="text-center">เริ่มต้น</th>
                    <th class="text-center">สิ้นสุด</th>
                  </tr>
                </thead>
                <tbody>

                  <?PHP foreach ($list as $key => $_list) { ?>
                    <tr>
                      <td class="text-center"><?= $key + 1; ?></td>
                      <td class="text-center"><?= $_list['car_licence']; ?></td>
                      <td class="text-center"><?= get_car_type_name($_list['car_type_id']); ?> <?= $_list['car_brand']; ?> <?= $_list['car_model']; ?></td>
                      <td class="text-center"><?= $_list['car_lend_place']; ?></td>
                      <td class="text-center"><?= $_list['car_lend_starttime']; ?></td>
                      <td class="text-center"><?= $_list['car_lend_endtime']; ?></td>
                    </tr>
                  <?PHP } ?>

                  <?PHP if (count($list) == 0) { ?>
                    <tr>
                      <td colspan="7" style="color: red; text-align: center;">ไม่พบข้อมูล</td>
                    </tr>
                  <?PHP } ?>
                </tbody>
              </table>

              <hr>

              <center>
                <a href="modules/print/print_report_booking_car.php?Type=<?= $_GET['Type']; ?>&Car=<?= $_GET['Car']; ?>&start=<?= $start; ?>&end=<?= $end; ?>" target="_blank" class="btn btn-lg btn-primary ">
                  พิมพ์รายงาน
                </a>
              </center>

            </div>

          </div>


        </div>


      </div>


    </div>
  </div>

</div>