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
      <h1 class="text-center text-truncate h3 mb-4">ห้องพักของฉัน</h1>

      <div class="row d-flex justify-content-center">

        <?PHP
        $renter_id = check_session('id');
        $sql = "SELECT * FROM tb_roomer a inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id inner join tb_dorm d on b.dorm_id = d.dorm_id where renter_id = '{$renter_id}' and a.roomer_status < 5";
        $check = row_array($sql);
        ?>

        <?PHP if ($check) { ?>
          <div class="col-md-8 col-md-offset-2">
            <div class="list-single">
              <div class="row">
                <div class="col-lg-4">
                  <img src="uploads/<?= $check['dorm_picture']; ?>" class="img-responsive" alt="">
                </div>

                <div class="col-lg-5">
                  <h2><?= $check['dorm_name']; ?></h2>
                  <p>
                    <b>ห้อง : </b> <?= $check['dorm_room_name']; ?>
                  </p>
                  <p>
                    <b>ราคา : </b> <?= number_format($check['dorm_price']); ?>
                  </p>
                  <p>
                    <b>รายละเอียด : </b> <?= $check['dorm_detail']; ?>
                  </p>
                  <p>
                    <b>สิทธิการเข้าพัก : </b> <?= dorm_position($check['dorm_position']); ?>
                  </p>
                  <p>
                    <b>สถานะการเข้าพัก : </b> <?= roomer_status($check['roomer_status']); ?>
                    <?PHP
                      if ($check['roomer_status'] == 2 || $check['roomer_status'] == 3) {
                        echo "<br>[ <b>แจ้งออกวันที่ :</b> {$check['roomer_date_out']} ]";
                      }
                      ?>
                  </p>

                </div>
                <div class="col-lg-3">
                  <a style="width: 100%; margin-top: 10px" data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=dorm/dorm_room_detail&dorm_id=<?= $check['dorm_id']; ?>&id=<?= $check['dorm_room_id']; ?>" class="btn btn-info">รายละเอียด</a>

                  <?PHP if ($check['roomer_status'] == 0) { ?>
                    <a href="process/update_roomer.php?status=9&id=<?= $check['roomer_id']; ?>&dorm_room_id=<?= $check['dorm_room_id']; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการยกเลิกการจอง?')" style="width: 100%; margin-top: 10px">ยกเลิกการจอง</a>
                  <?PHP } ?>
                </div>
              </div>
            </div>

            <?PHP if ($check['roomer_status'] > 0) { ?>
              <hr>

              <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-4 text-center text-lg-right my-1">
                <button type="button" class="btn btn-warning btn-kang">
                  ยอดค้างชำระเงินของฉัน
                </button>
                </div>
                <div class="col-md-12 col-lg-4 text-center my-1">
                <button type="button" class="btn btn-success btn-no-kang">
                  ประวัติการชำระเงินของฉัน
                </button>
                </div>

                <?PHP if ($check['roomer_status'] != 2 && $check['roomer_status'] != 3) { ?>
                <div class="col-md-12 col-lg-4 text-center text-lg-left my-1">
                  <?PHP 
                  $room_id = $check['dorm_room_id'];
                  $sql2 = "SELECT COUNT(dorm_payment_status) AS cnt FROM tb_dorm_payment WHERE dorm_room_id = $room_id AND dorm_payment_status = 0";
                  $check_not_pay = row_array($sql2);
                  if ($check_not_pay['cnt'] > 0) { 
                    $Title = "ไม่สามารถแจ้งออกได้";
                    $Text = "ต้องชำระค่าหอพักก่อน";
                    $Type = "warning";
                  ?>
                    
                    <a data-remote="false" class="btn btn-danger text-white" onclick="AlertError('<?= $Title; ?>','<?= $Text; ?>','<?= $Type; ?>')">
                  <?PHP } else {?>
                    <a data-remote="false" data-toggle="modal" data-target="#hrefModal" class="btn btn-danger" href="index.php?module=modal&action=dorm/roomer_out_form&roomer_id=<?= $check['roomer_id']; ?>">
                  <?PHP } ?>
                    แจ้งออกหอพัก
                  </a>
                </div>
                <?PHP } ?>
              </div>

              <hr>

              <div class="kang">
                <h4 class="text-center">ยอดค้างชำระเงินของฉัน</h4>

                <?PHP
                    $sql = "SELECT * FROM tb_dorm_payment a inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id inner join tb_dorm d on b.dorm_id = d.dorm_id WHERE dorm_payment_status = 0 and a.dorm_room_id = '{$check['dorm_room_id']}' order by a.dorm_payment_id desc ";
                    $list = result_array($sql);
                    ?>

                <?PHP foreach ($list as $_list) { ?>

                  <?PHP $total = $_list['dorm_payment_price'] + $_list['dorm_payment_electric'] + $_list['dorm_payment_water'] + $_list['dorm_payment_other']; ?>


                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="2" class="text-center">
                          ยอดค้างประจำเดือน <?= month_name($_list['dorm_payment_month']); ?> <?= $_list['dorm_payment_year']; ?>
                          <a href="modules/print/print_alert_dorm_payment.php?dorm_payment_id=<?= $_list['dorm_payment_id']; ?>" target="_blank" class="btn btn-primary btn-xs">
                            <i class="fa fa-file-text"></i> ใบแจ้งหนี้
                          </a>
                        </th>
                      </tr>
                      <tr>
                        <th class="text-center">รายการ</th>
                        <th class="text-center">ราคา</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">
                          ค่าห้อง
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_price']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          ค่าไฟ
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_electric']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          ค่าน้ำ
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_water']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          ค่าอื่นๆ
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_other']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          รวมทั้งหมด
                        </td>
                        <td class="text-center">
                          <?= number_format($total); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          หมายเหตุ : <?= $_list['dorm_payment_msg']; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                <?PHP } ?>

                <?PHP if (count($list) == 0) { ?>
                  <p style="background: #a9ffb0; padding: 20px; text-align: center;">
                    ไม่มียอดค้างชำระเงิน
                  </p>
                <?PHP } ?>

              </div>

              <div class="no-kang" style="display: none;">
                <h4 class="text-center">ประวัติการชำระเงินของฉัน</h4>

                <?PHP
                    $sql = "SELECT * FROM tb_dorm_payment a 
                            inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id 
                            inner join tb_dorm d on b.dorm_id = d.dorm_id 
                            WHERE dorm_payment_status = 1 
                            and a.dorm_room_id = '{$check['dorm_room_id']}' 
                            and a.show_mydorm = 1 
                            order by a.dorm_payment_id desc ";
                    $list = result_array($sql);
                    ?>

                <?PHP foreach ($list as $_list) { ?>

                  <?PHP $total = $_list['dorm_payment_price'] + $_list['dorm_payment_electric'] + $_list['dorm_payment_water'] + $_list['dorm_payment_other']; ?>

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="2" class="text-center">
                          ประจำเดือน <?= month_name($_list['dorm_payment_month']); ?> <?= $_list['dorm_payment_year']; ?>
                          <a href="modules/print/print_dorm_payment.php?dorm_payment_id=<?= $_list['dorm_payment_id']; ?>" target="_blank" class="btn btn-primary btn-xs">
                            <i class="fa fa-file-text"></i> ใบเสร็จรับเงิน
                          </a>
                        </th>
                      </tr>
                      <tr>
                        <th class="text-center">รายการ</th>
                        <th class="text-center">ราคา</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">
                          ค่าห้อง
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_price']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          ค่าไฟ
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_electric']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          ค่าน้ำ
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_water']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          ค่าอื่นๆ
                        </td>
                        <td class="text-center">
                          <?= number_format($_list['dorm_payment_other']); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          รวมทั้งหมด
                        </td>
                        <td class="text-center">
                          <?= number_format($total); ?> บาท
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          หมายเหตุ : <?= $_list['dorm_payment_msg']; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                <?PHP } ?>

                <?PHP if (count($list) == 0) { ?>
                  <p style="background: #a9ffb0; padding: 20px; text-align: center;">
                    ไม่มีประวัติการชำระเงิน
                  </p>
                <?PHP } ?>

              </div>

            <?PHP } ?>

          </div>

        <?PHP } else { ?>
          <p style="color: #ff0000; text-align: center; font-size: 30px; padding: 30px 0;">
            ไม่มีรายชื่อคุณในระบบหอพัก
          </p>
        <?PHP } ?>


      </div>
    </div>


  </div>
</div>

</div>


<script>
  $(document).ready(function() {
    $(".btn-kang").click(function() {
      $(".no-kang").hide();
      $(".kang").show();
    });

    $(".btn-no-kang").click(function() {
      $(".kang").hide();
      $(".no-kang").show();
    });
  });
</script>