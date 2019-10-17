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
      <?PHP
      $yy = date("Y");
      $mm = date("m");
      if (isset($_GET['yy']) && isset($_GET['mm'])) {
        $yy = $_GET['yy'];
        $mm = $_GET['mm'];
      }

      $dorm_id = $_GET['dorm_id'];
      $sql = "SELECT * FROM tb_dorm where dorm_id = '{$dorm_id}'";
      $title = row_array($sql);
      ?>
      <h1 class="text-center text-truncate h3 mb-4">ค่าใช้จ่ายหอพัก : <?= $title['dorm_name']; ?></h1>

      <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">
          <div class="list-single">
            <div class="row">
              <div class="col-md-3">
                <img src="uploads/<?= $title['dorm_picture']; ?>" class="img-responsive" alt="">
              </div>

              <div class="col-md-6">
                <h2><?= $title['dorm_name']; ?></h2>
                <p>
                  <b>ราคา : </b> <?= number_format($title['dorm_price']); ?>
                </p>
                <p>
                  <b>รายละเอียด : </b> <?= $title['dorm_detail']; ?>
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <hr>
          <form action="" method="get">
            <input type="hidden" name="module" value="dorm">
            <input type="hidden" name="action" value="dorm_payment_room">
            <input type="hidden" name="dorm_id" value="<?= $dorm_id; ?>">
            <div class="row">
              <label class="col-md-2 text-md-right control-label" style="font-size: 18px; padding-top: 10px;">เดือน</label>

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


              <div class="col-md-3" style="padding-top: 4px;">
                <select name="yy" class="form-control" required>
                  
                  <?PHP 
                  $this_year = date("Y");
                  echo $this_year;
                  for ($y = ($this_year-1); $y <= ($this_year+1); $y++) { ?>
                    <option <?= $yy == $y ? "selected" : ""; ?> value="<?= $y; ?>"><?= $y; ?></option>
                  <?PHP } ?>
                </select>
              </div>


              <div class="col-md-2 " style="padding-top: 4px; padding-left: 20px">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
          <hr>
        </div>
      </div>

      <div class="row d-flex justify-content-center">

          <?PHP
          $sql = "SELECT * FROM tb_dorm_room a inner join tb_dorm b on a.dorm_id = b.dorm_id where a.delete_data = 0 and a.dorm_id = '{$dorm_id}'";
          $list = result_array($sql);
          ?>


          <?PHP foreach ($list as $key => $_list) { ?>

            <?PHP
              $green = "#c1f5d4";
              $red = "#ffcac8";
              $bg = "#ffffff";
              $status = "รอลงข้อมูล";

              $url = "index.php?module=modal&action=dorm/dorm_payment_room_form&id={$_list['dorm_room_id']}&mm={$mm}&yy={$yy}";

              $sql = "SELECT * FROM tb_dorm_payment WHERE dorm_payment_status < 5 AND dorm_room_id = '{$_list['dorm_room_id']}' AND dorm_payment_month = '{$mm}' AND dorm_payment_year = '{$yy}'";
              $check = row_array($sql);

              if ($check) {
                $status = dorm_payment_status($check['dorm_payment_status']);

                if ($check['dorm_payment_status'] == 0) {
                  $url = "index.php?module=modal&action=dorm/dorm_payment_room_form&id={$_list['dorm_room_id']}&mm={$mm}&yy={$yy}&dorm_payment_id={$check['dorm_payment_id']}";
                  $bg = $red;
                } elseif ($check['dorm_payment_status'] == 1) {
                  $url = "index.php?module=modal&action=dorm/dorm_payment_room_detail&dorm_payment_id={$check['dorm_payment_id']}";
                  $bg = $green;
                }
              }

              ?>

            <?PHP
              $sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$_list['dorm_room_id']}' AND roomer_status BETWEEN 1 and 4";
              $cc = result_array($sql);
              $count_pp = count($cc);
              ?>

            <?PHP if ($count_pp > 0) { ?>
              <div class="col" style="max-width:250px; min-width:250px;">
                <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="<?= $url; ?>">
                  <div class="list-driver" style="background: <?= $bg; ?>">
                    <div class="col-md-12">
                      <p style="font-size: 25px; font-weight: bold; padding: 10px 0;">
                        <?= $_list['dorm_room_name']; ?>
                      </p>
                      <p class="text-center" style="overflow: hidden; height: 40px; margin-bottom: 0;">
                        <?= $status; ?>
                      </p>
                    </div>
                  </div>
                </a>

              </div>
            <?PHP } else { ?>
              <div class="col" style="max-width:250px; min-width:250px;">
                <div class="list-driver" style="background: #ccc;">
                  <div class="col-md-12">
                    <p style="font-size: 25px; font-weight: bold; padding: 10px 0;">
                      <?= $_list['dorm_room_name']; ?>
                    </p>
                    <p class="text-center" style="overflow: hidden; height: 40px; margin-bottom: 0;">
                      ไม่มีผู้เข้าพัก
                    </p>
                  </div>
                </div>
              </div>
            <?PHP } ?>


          <?PHP } ?>
          </tbody>
      </div>


    </div>

  </div>