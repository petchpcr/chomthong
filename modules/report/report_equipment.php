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
        $e_type = $_GET['equip_type'];
        $equip = $_GET['equip'];
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

                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    หมวดหมู่
                    <?PHP
                    $sql = "SELECT DISTINCT equipment_type FROM tb_equipment WHERE delete_data = 0";
                    $list_equip = result_array($sql);
                    ?>
                    <select id="xequip_type" name="equip_type" class="form-control" onchange="get_qeuip_type()">
                      <option value="">ทุกหมวดหมู่</option>
                      <?PHP foreach ($list_equip as $_equip) { ?>
                        <option <?= $_equip['equipment_type'] == $e_type ? "selected" : ""; ?> value="<?= $_equip['equipment_type']; ?>"><?= $_equip['equipment_type']; ?></option>
                      <?PHP } ?>
                    </select>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    ครุภัณฑ์
                    <select id="xEquip" name="equip" class="form-control">
                      <?php
                      $sql = "SELECT equipment_id AS xEquip ,equipment_code AS cEquip ,equipment_name AS nEquip
                              FROM tb_equipment 
                              WHERE equipment_type LIKE '%{$e_type}%'
                              ORDER BY equipment_name ASC , equipment_code ASC";
                      $list_equip = result_array($sql);
                      ?>
                      <option value="">ทุกรายการ</option>
                      <?PHP foreach ($list_equip as $key => $_equip) { ?>
                        <option <?= $equip == $_equip['xEquip'] ? "selected" : ""; ?> value="<?= $_equip['xEquip']; ?>"><?= $_equip['cEquip']." : ".$_equip['nEquip']; ?></option>
                      <?PHP } ?>
                    </select>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    วันที่
                    <input type="date" name="start" value="<?= $start; ?>" class="form-control" required>
                  </div>

                  <div class="col-12 col-md-6 col-lg-3 mb-2">
                    ถึง
                    <div class="d-flex">
                      <input type="date" name="end" value="<?= $end; ?>" class="form-control mr-2" required>
                      <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>

                </div>
              </form>
              <hr>

              <?PHP
              $sql = "SELECT * FROM tb_equipment_lend z 
                      inner join tb_equipment a on z.equipment_id = a.equipment_id 
                      inner join tb_building_room b on a.building_room_id = b.building_room_id 
                      inner join tb_building d on b.building_id = d.building_id 
                      where z.equipment_lend_status = 3 
                      and a.equipment_type like '%{$e_type}%' 
                      and z.equipment_id like '%{$equip}%' 
                      and equipment_lend_date between '{$start}' and '{$end}' 
                      ORDER BY a.equipment_name ASC , a.equipment_code ASC";
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
                <a href="modules/print/print_report_equipment.php?equip_type=<?= $e_type; ?>&equip=<?= $equip; ?>&start=<?= $start; ?>&end=<?= $end; ?>" target="_blank" class="btn btn-lg btn-primary ">
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