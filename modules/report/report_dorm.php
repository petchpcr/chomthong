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
        $yy = date("Y");
        $mm = date("m");
        $floor = "";
        $dorm_id = "";
        $room = "";

        if (isset($_GET['dorm_id'])) {
          $dorm_id = $_GET['dorm_id'];
        }
        if (isset($_GET['floor'])) {
          $floor = $_GET['floor'];
        }
        if (isset($_GET['room'])) {
          $room = $_GET['room'];
        }
        if (isset($_GET['yy'])) {
          $yy = $_GET['yy'];
        }
        if (isset($_GET['mm'])) {
          $mm = $_GET['mm'];
        }
        
        ?>

        <div class="col-lg-12">
          <hr>

          <div style="background: #fff; padding: 20px; min-height: 300px">
            <?PHP include 'include/menu_report.php'; ?>

            <div style="padding: 20px">
              <form action="" method="get">
                <input type="hidden" name="module" value="report">
                <input type="hidden" name="action" value="report_dorm">
                <div class="row">

                  <div class="col-12 col-md-6 col-lg-3">
                    หอพัก
                    <?PHP
                    $sql = "SELECT * FROM tb_dorm WHERE delete_data = 0";
                    $cc = result_array($sql);
                    ?>
                    <select id="xdorm_id" name="dorm_id" class="form-control" onchange="get_floor()">
                      <option value="">ทุกหอ</option>
                      <?PHP foreach ($cc as $_cc) { ?>
                        <option <?= $_cc['dorm_id'] == $dorm_id ? "selected" : ""; ?> value="<?= $_cc['dorm_id']; ?>"><?= $_cc['dorm_name']; ?></option>
                      <?PHP } ?>
                    </select>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="form-row">
                      <div class="form-group col">
                        ชั้น
                        <select id="xFloor" name="floor" class="form-control">
                          <?php
                          $sql = "SELECT DISTINCT SUBSTRING(dorm_room_name,1,1) AS xFloor
                                    FROM tb_dorm_room 
                                    WHERE dorm_id LIKE '%{$dorm_id}%'";
                          $list_floor = result_array($sql);
                          ?>
                          <option value="">ทุกชั้น</option>
                          <?PHP foreach ($list_floor as $key => $_floor) { ?>
                            <option <?= $floor == $_floor['xFloor'] ? "selected" : ""; ?> value="<?= $_floor['xFloor']; ?>"><?= "ชั้น ".$_floor['xFloor']; ?></option>
                          <?PHP } ?>
                        </select>
                      </div>

                      <div class="form-group col" style="max-width:70px;">
                        ห้อง
                        <input type="text" name='room' class="form-control text-center numberOnly" maxlength="3" value="<?= $room; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3">
                    เดือน
                    <select name="mm" class="form-control">
                      <option <?= $mm == 1 ? "selected" : ""; ?> value="1">
                        มกราคม
                      </option>
                      <option <?= $mm == 2 ? "selected" : ""; ?> value="2">
                        กุมภาพันธ์
                      </option>
                      <option <?= $mm == 3 ? "selected" : ""; ?> value="3">
                        มีนาคม
                      </option>
                      <option <?= $mm == 4 ? "selected" : ""; ?> value="4">
                        เมษายน
                      </option>
                      <option <?= $mm == 5 ? "selected" : ""; ?> value="5">
                        พฤษภาคม
                      </option>
                      <option <?= $mm == 6 ? "selected" : ""; ?> value="6">
                        มิถุนายน
                      </option>
                      <option <?= $mm == 7 ? "selected" : ""; ?> value="7">
                        กรกฎาคม
                      </option>
                      <option <?= $mm == 8 ? "selected" : ""; ?> value="8">
                        สิงหาคม
                      </option>
                      <option <?= $mm == 9 ? "selected" : ""; ?> value="9">
                        กันยายน
                      </option>
                      <option <?= $mm == 10 ? "selected" : ""; ?> value="10">
                        ตุลาคม
                      </option>
                      <option <?= $mm == 11 ? "selected" : ""; ?> value="11">
                        พฤศจิกายน
                      </option>
                      <option <?= $mm == 12 ? "selected" : ""; ?> value="12">
                        ธันวาคม
                      </option>
                    </select>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3">
                    ปี
                    <?PHP
                    $sql = "SELECT DISTINCT dorm_payment_year FROM tb_dorm_payment ORDER BY dorm_payment_year ASC";
                    $years = result_array($sql);
                    ?>
                    <div class="d-flex">
                      <select name="yy" class="form-control mr-2">
                        <?PHP foreach ($years as $key => $_years) { ?>
                          <option <?= $yy == $_years['dorm_payment_year'] ? "selected" : ""; ?> value="<?= $_years['dorm_payment_year']; ?>"><?= $_years['dorm_payment_year']; ?></option>
                        <?PHP } ?>
                      </select>
                      <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <hr>

              <?PHP if (isset($_GET['dorm_id']) && isset($_GET['yy']) && isset($_GET['mm'])) { ?>

                <?PHP
                  $sql = "SELECT * FROM tb_dorm_payment a 
                          inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id 
                          inner join tb_dorm d on b.dorm_id = d.dorm_id 
                          where dorm_payment_status = 1
                          and dorm_payment_month = '{$mm}' 
                          and dorm_payment_year = '{$yy}' 
                          and b.dorm_id LIKE '%{$dorm_id}%' 
                          and b.dorm_room_name LIKE '{$floor}%' 
                          and b.dorm_room_name LIKE '%{$room}%' 
                          order by b.dorm_id asc , b.dorm_room_name asc";

                  $list = result_array($sql);
                  ?>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th width="50" class="text-center">ลำดับ</th>
                      <th class="text-center">รายละเอียด</th>
                      <th width="120" class="text-center">หอพัก</th>
                      <th width="120" class="text-center">ห้อง</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?PHP foreach ($list as $key => $_list) { ?>
                      <?PHP $total = $_list['dorm_payment_price'] + $_list['dorm_payment_electric'] + $_list['dorm_payment_water'] + $_list['dorm_payment_other']; ?>
                      <tr>
                        <td class="text-center"><?= $key + 1; ?></td>
                        <td class="text-left">

                          <p>
                            <b>ยอดรวม : </b> <?= number_format($total); ?> บาท
                          </p>

                          <p>
                            <b>ประจำเดือน
                              : </b> <?= month_name($_list['dorm_payment_month']); ?> <?= $_list['dorm_payment_year']; ?>
                          </p>

                          <p>
                            <b>วันที่ออกใบแจ้ง : </b> <?= $_list['dorm_payment_date_invoice']; ?>
                          </p>
                          <p>
                            <b>วันที่ชำระเงิน : </b> <?= $_list['dorm_payment_date_pay']; ?>
                          </p>
                          <p>
                            <b>สถานะ
                              : </b> <?= dorm_payment_status($_list['dorm_payment_status']); ?>
                          </p>
                        </td>
                        <td class="text-center"><?= $_list['dorm_name']; ?></td>
                        <td class="text-center"><?= $_list['dorm_room_name']; ?></td>
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
                  <a href="modules/print/print_report_dorm.php?dorm_id=<?= $dorm_id; ?>&floor=<?= $floor; ?>&room=<?= $room; ?>&mm=<?= $mm; ?>&yy=<?= $yy; ?>" target="_blank" class="btn btn-lg btn-primary ">
                    พิมพ์รายงาน
                  </a>
                </center>

              <?PHP } else { ?>
                <p style="text-align: center; color: red; font-size: 20px; padding: 80px;">
                  กรุณาเลือกข้อมูล
                </p>
              <?PHP } ?>

            </div>

          </div>


        </div>


      </div>


    </div>
  </div>

</div>