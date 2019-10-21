<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-building"></i>
        </div>
      </div>
      <?PHP
      $building_id = $_GET['building_id'];
      $sql = "SELECT * FROM tb_building where building_id = '{$building_id}'";
      $title = row_array($sql);
      ?>
      <h1 class="text-center text-truncate h3 mb-4">ห้องภายใน : <?= $title['building_name']; ?></h1>

      <div class="row">

        <div class="col-lg-12">
          <div class="text-right mb-3">
            <a href="index.php?module=modal&action=building/building_room_form&building_id=<?= $building_id; ?>" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
              <i class="fa fa-plus"></i>
              เพิ่มข้อมูล</a>
          </div>

          <?PHP
          $sql = "SELECT * FROM tb_building_room a inner join tb_building b on a.building_id = b.building_id where a.delete_data = 0 and a.building_id = '{$building_id}'";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <!-- <th width="50" class="text-center">ลำดับ</th> -->
                  <th class="text-center">อาคาร</th>
                  <th class="text-center">ห้อง</th>
                  <th class="text-center">รายละเอียด</th>
                  <th class="text-center">ประเภท</th>
                  <th width="50" class="text-center">แก้ไข</th>
                  <th width="50" class="text-center">ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) {
                  $Title = "ยืนยันการลบ";
                  $Text = "ต้องการลบห้อง ".$_list['building_room_name']." หรือไม่ ?";
                  $Color = "#d33";
                  $Link = "process/delete.php?table=tb_building_room&ff=building_room_id&id=" . $_list['building_room_id'];
                  ?>
                  <tr>
                    <!-- <td class="text-center"><?= $key + 1; ?></td> -->
                    <td class="text-center"><?= $_list['building_name']; ?></td>
                    <td class="text-center"><?= $_list['building_room_name']; ?></td>
                    <td class="text-center"><?= $_list['building_room_detail']; ?></td>
                    <td class="text-center"><?= $_list['building_room_type']; ?></td>
                    <td class="text-center">
                      <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=building/building_room_form&building_id=<?= $building_id; ?>&id=<?= $_list['building_room_id']; ?>" class="btn btn-sm btn-warning btn-rounded">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
                    <td class="text-center">
                      <button onclick="AlertConLink('<?= $Title; ?>', '<?= $Text; ?>', '<?= $Color; ?>', '<?= $Link; ?>')" class="btn btn-sm btn-danger">
                        <i class="fa fa-times"></i>
                      </button>
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

</div>