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
      <h1 class="text-center text-truncate h3 mb-4">จัดการครุภัณฑ์</h1>

    <div class="row">
      <div class="col-lg-12">
        <div class="text-right mb-3">
          <a href="index.php?module=modal&action=equipment/equipment_form" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
            <i class="fa fa-plus"></i>
            เพิ่มครุภัณฑ์</a>
        </div>

        <?PHP
        $sql = "SELECT * FROM tb_equipment a inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where a.delete_data = 0";
        $list = result_array($sql);
        ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="table-js">
            <thead>
              <tr>
                <th class="text-center">รหัส</th>
                <th width="50" class="text-center">รูป</th>
                <th class="text-center">รายการ</th>
                <th class="text-center">หมวดหมู่</th>
                <th class="text-center">อาคาร / ห้อง</th>
                <th width="50" class="text-center">แก้ไข</th>
                <th width="80" class="text-center">เสีย / ทิ้ง</th>
              </tr>
            </thead>
            <tbody>
              <?PHP foreach ($list as $key => $_list) { ?>
                <tr>
                  <td class="text-center"><?= $_list['equipment_code']; ?></td>
                  <td class="text-center">
                    <img src="uploads/<?= $_list['equipment_picture']; ?>" class="img-responsive" alt="">
                  </td>
                  <td class="text-center"><?= $_list['equipment_name']; ?></td>
                  <td class="text-center"><?= $_list['equipment_type']; ?></td>
                  <td class="text-center"><?= $_list['building_name']; ?> / <?= $_list['building_room_name']; ?></td>
                  <td class="text-center">
                    <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=equipment/equipment_form&id=<?= $_list['equipment_id']; ?>" class="btn btn-sm btn-warning btn-rounded">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                  <td class="text-center">
                    <a href="process/delete.php?table=tb_equipment&ff=equipment_id&id=<?= $_list['equipment_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการเสีย / ทิ้ง?');">
                      <i class="fa fa-times"></i>
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