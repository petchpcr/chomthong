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
        ?>

        <div class="col-lg-12">
          <hr>

          <div style="background: #fff; padding: 20px; min-height: 300px">
            <?PHP include 'include/menu_report.php'; ?>

            <div style="padding: 20px">
              <form action="" method="get">
                <input type="hidden" name="module" value="report">
                <input type="hidden" name="action" value="report_equipment">
                <div class="row">
                  <label class="col-md-2 text-md-right control-label" style="font-size: 18px; padding-top: 10px;">วันที่</label>

                  <div class="col-md-3" style="padding-top: 4px;">
                    <input type="date" name="start" value="<?= $start; ?>" class="form-control" required>
                  </div>

                  <label class="col-md-1 text-md-right control-label" style="font-size: 18px; padding-top: 10px;">ถึง</label>


                  <div class="col-md-3" style="padding-top: 4px;">
                    <input type="date" name="end" value="<?= $end; ?>" class="form-control" required>
                  </div>


                  <div class="col-md-2 " style="padding-top: 4px; padding-left: 20px">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
              <hr>

              <?PHP
              $sql = "SELECT * FROM tb_equipment_lend z inner join tb_equipment a on z.equipment_id = a.equipment_id inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where equipment_lend_status = 3 and equipment_lend_date between '{$start}' and '{$end}' ";
              $list = result_array($sql);
              ?>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="50" class="text-center">ลำดับ</th>
                    <th class="text-center">รหัสครุภัณฑ์</th>
                    <th class="text-center">รายการ</th>
                    <th class="text-center">หมวดหมู่</th>
                    <th class="text-center">อาคาร</th>
                    <th class="text-center">ผู้ยืม</th>
                  </tr>
                </thead>
                <tbody>

                  <?PHP foreach ($list as $key => $_list) { ?>
                    <tr>
                      <td class="text-center"><?= $key + 1; ?></td>
                      <td class="text-center"><?= $_list['equipment_code']; ?></td>
                      <td class="text-center"><?= $_list['equipment_name']; ?></td>
                      <td class="text-center"><?= $_list['equipment_type']; ?></td>
                      <td class="text-center"><?= $_list['building_name']; ?></td>
                      <td class="text-center">
                        <?php $user = get_text_user_id($_list['lender_id']); ?>

                        <?= $user['name']; ?> <?= $user['lastname']; ?>
                      </td>
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
                <a href="modules/print/print_report_equipment.php?start=<?= $start; ?>&end=<?= $end; ?>" target="_blank" class="btn btn-lg btn-primary ">
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