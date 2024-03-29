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
      <h1 class="text-center text-truncate h3 mb-4">คืนครุภัณฑ์</h1>

      <div class="row">
        <div class="col-lg-12">

          <?PHP
          $sql = "SELECT * FROM tb_equipment_lend z inner join tb_equipment a on z.equipment_id = a.equipment_id inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where equipment_lend_status = 2 order by equipment_lend_status asc";
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
                  <th width="60" class="text-center">คืนของ</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { 
                  $Title = "ยืนยันการคืนของ";
                  $Text = "ผู้จองคืนครุภัฑณ์เรียบร้อยแล้วใช่หรือไม่ ?";
                  $Color = "#1cc88a";
                  $Link = "process/update_equipment_lend.php?status=3&id=" . $_list['equipment_lend_id'];
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
                      <?PHP if ($_list['equipment_lend_status'] == 2) { ?>
                        <button class="btn btn-sm btn-success" onclick="AlertConLink('<?= $Title; ?>', '<?= $Text; ?>', '<?= $Color; ?>', '<?= $Link; ?>')">
                          <i class="fa fa-check"></i>
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