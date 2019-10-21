<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-archive"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">รับครุภัณฑ์</h1>

      <div class="row">
        <div class="col-lg-12">


          <?PHP
          $sql = "SELECT * FROM tb_equipment_lend z inner join tb_equipment a on z.equipment_id = a.equipment_id inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where equipment_lend_status = 1 order by equipment_lend_status asc";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <th width="50" class="text-center">รูป</th>
                  <th class="text-center">รหัส</th>
                  <th class="text-center">รายการ</th>
                  <th class="text-center">หมวดหมู่</th>
                  <th class="text-center">อาคาร / ห้อง</th>
                  <th width="120" class="text-center">สถานะ</th>
                  <th width="60" class="text-center">รับของ</th>
                  <th width="65" class="text-center">ยกเลิก</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { 
                  $App_Title = "ยืนยันการรับของ";
                  $App_Text = "ผู้จองได้รับครุภัฑณ์แล้วใช่หรือไม่ ?";
                  $App_Color = "#1cc88a";
                  $App_Link = "process/update_equipment_lend.php?status=2&id=" . $_list['equipment_lend_id'];
    
                  $Un_Title = "ยืนยันการยกเลิก";
                  $Un_Text = "ยกเลิกการยืมครุภัณฑ์ใช่หรือไม่ ?";
                  $Un_Color = "#d33";
                  $Un_Link = "process/update_equipment_lend.php?status=8&id=" . $_list['equipment_lend_id'];
                  ?>
                  <tr>
                    <td class="text-center">
                      <img src="uploads/<?= $_list['equipment_picture']; ?>" class="img-responsive" alt="">
                    </td>
                    <td class="text-center"><?= $_list['equipment_code']; ?></td>
                    <td class="text-center"><?= $_list['equipment_name']; ?></td>
                    <td class="text-center"><?= $_list['equipment_type']; ?></td>
                    <td class="text-center"><?= $_list['building_name']; ?>
                      / <?= $_list['building_room_name']; ?></td>
                    <td class="text-center"><?= equipment_lend_status($_list['equipment_lend_status']); ?></td>
                    <td class="text-center">
                      <?PHP if ($_list['equipment_lend_status'] == 1) { ?>
                        <button class="btn btn-sm btn-success" onclick="AlertConLink('<?= $App_Title; ?>', '<?= $App_Text; ?>', '<?= $App_Color; ?>', '<?= $App_Link; ?>')">
                          <i class="fa fa-check"></i>
                        </button>
                      <?PHP } ?>
                    </td>
                    <td class="text-center">
                      <?PHP if ($_list['equipment_lend_status'] == 1) { ?>
                        <button class="btn btn-sm btn-danger" onclick="AlertConLink('<?= $Un_Title; ?>', '<?= $Un_Text; ?>', '<?= $Un_Color; ?>', '<?= $Un_Link; ?>')">
                          <i class="fa fa-times"></i>
                        </button>
                      <?PHP } ?>
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