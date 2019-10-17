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
      <h1 class="text-center text-truncate h3 mb-4">จัดการอาคาร</h1>

      <div class="row">
        <div class="col-lg-12">
          <div class="text-right mb-3">
            <a href="index.php?module=modal&action=building/building_form" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
              <i class="fa fa-plus"></i>
              เพิ่มข้อมูล
            </a>
          </div>



          <?PHP
          $sql = "SELECT * FROM tb_building where delete_data = 0";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <!-- <th width="50" class="text-center">ลำดับ</th> -->
                  <th width="60" class="text-center">รูปภาพ</th>
                  <th class="text-center">รายการ</th>
                  <th class="text-center">รายละเอียด</th>
                  <th width="120" class="text-center">ห้อง</th>
                  <th width="50" class="text-center">แก้ไข</th>
                  <th width="50" class="text-center">ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { ?>
                  <tr>
                    <!-- <td class="text-center"><?= $key + 1; ?></td> -->
                    <td class="text-center">
                      <img src="uploads/<?= $_list['building_picture']; ?>" style="width: auto; height: 50px;" alt="">
                    </td>
                    <td class="text-center"><?= $_list['building_name']; ?></td>
                    <td class="text-center"><?= $_list['building_detail']; ?></td>
                    <td class="text-center">
                      <a href="index.php?module=building&action=list_building_room&building_id=<?= $_list['building_id']; ?>" class="btn btn-info">เรียกดู</a>
                    </td>
                    <td class="text-center">
                      <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=building/building_form&id=<?= $_list['building_id']; ?>" class="btn btn-sm btn-warning btn-rounded">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
                    <td class="text-center">
                      <a href="process/delete.php?table=tb_building&ff=building_id&id=<?= $_list['building_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบ?');">
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

</div>