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
      <h1 class="text-center text-truncate h3 mb-4">ชำระเงิน</h1>

      <?PHP
      $yy = date("Y");
      $mm = date("m");
      if (isset($_GET['yy'])) {
        $yy = $_GET['yy'];
      }
      if (isset($_GET['mm'])) {
        $mm = $_GET['mm'];
      }
      $yy_sql = "AND dorm_payment_year = ".$yy;
      $mm_sql = "AND dorm_payment_month = ".$mm;

      $dorm_id = "";
      if ($_GET['dorm'] != "") {
        $dorm_id = "AND b.dorm_id = ".$_GET['dorm'];
      }
      ?>

      <div class="row">
      <div class="col-lg-12">
          <hr>
          <form action="" method="get">
            <input type="hidden" name="module" value="dorm">
            <input type="hidden" name="action" value="appove_dorm_payment">
            <input type="hidden" name="dorm_id" value="<?= $_GET['dorm_id']; ?>">
            <div class="row">
              <label class="col-md-1 text-md-right control-label" style="font-size: 18px; padding-top: 10px;">หอพัก</label>
              <?PHP
                $sql = "SELECT dorm_id,dorm_name FROM tb_dorm";
                $dorm = result_array($sql);
              ?>
              <div class="col-md-3" style="padding-top: 4px;">
                <select name="dorm" class="form-control" required>
                <option value="">เลือกหอพัก</option>
                <?PHP foreach ($dorm as $key => $_dorm) { ?>
                  <option <?= $_GET['dorm'] == $_dorm['dorm_id'] ? "selected" : ""; ?> value="<?= $_dorm['dorm_id']; ?>"><?= $_dorm['dorm_name']; ?></option>
                <?PHP } ?>
                </select>
              </div>

              <label class="col-md-1 text-md-right control-label" style="font-size: 18px; padding-top: 10px;">เดือน</label>

              <div class="col-md-3" style="padding-top: 4px;">
                <select name="mm" class="form-control" required>
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

              <label class="col-md-1 text-md-right control-label" style="font-size: 18px; padding-top: 10px;">ปี</label>


              <div class="col-md-2" style="padding-top: 4px;">
              <?PHP
                $sql = "SELECT DISTINCT dorm_payment_year FROM tb_dorm_payment ORDER BY dorm_payment_year ASC";
                $years = result_array($sql);
              ?>
                <select name="yy" class="form-control" required>
                  <?PHP foreach ($years as $key => $_years) { ?>
                    <option <?= $yy == $_years['dorm_payment_year'] ? "selected" : ""; ?> value="<?= $_years['dorm_payment_year']; ?>"><?= $_years['dorm_payment_year']; ?></option>
                  <?PHP } ?>
                </select>
              </div>


              <div class="col-md-1 " style="padding-top: 4px; padding-left: 20px">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
          <hr>
        </div>

        <div class="col-lg-12">


          <?PHP
          $sql = "SELECT * FROM tb_dorm_payment a 
                  inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id 
                  inner join tb_dorm d on b.dorm_id = d.dorm_id 
                  WHERE dorm_payment_status = 0
                  {$dorm_id} {$yy_sql} {$mm_sql}
                  ORDER BY b.dorm_id ASC , b.dorm_room_id ASC";

          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <th width="50" class="text-center">ลำดับ</th>
                  <th class="text-center">รายละเอียด</th>
                  <th width="120" class="text-center">หอพัก</th>
                  <th width="120" class="text-center">ห้อง</th>
                  <th width="180" class="text-center">จัดการ</th>
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
                        <b>ประจำเดือน : </b> <?= month_name($_list['dorm_payment_month']); ?> <?= $_list['dorm_payment_year']; ?>
                      </p>

                      <p>
                        <b>วันที่ออกใบแจ้ง : </b> <?= $_list['dorm_payment_date_invoice']; ?>
                      </p>
                      <p>
                        <b>สถานะ : </b> <?= dorm_payment_status($_list['dorm_payment_status']); ?>
                      </p>
                    </td>
                    <td class="text-center"><?= $_list['dorm_name']; ?></td>
                    <td class="text-center"><?= $_list['dorm_room_name']; ?></td>
                    <td class="text-center">
                      <a data-remote="false" data-toggle="modal" data-target="#hrefModal" class="btn btn-sm btn-info" href="index.php?module=modal&action=dorm/dorm_payment_room_detail&dorm_payment_id=<?= $_list['dorm_payment_id']; ?>">
                        รายละเอียด
                      </a>
                      <a href="process/update_dorm_payment.php?status=1&id=<?= $_list['dorm_payment_id']; ?>" class="btn btn-sm btn-success" onclick="return confirm('ยืนยันการทำรายการ?');">
                        ชำระเงิน
                      </a>
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