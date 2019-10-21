<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-id-card"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">จัดการพนักงานขับรถ</h1>

      <div class="row d-flex justify-content-center">
        <div class="col-12 text-right mb-3">
          <a href="index.php?module=modal&action=car/driver_form" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
            <i class="fa fa-plus"></i>
            เพิ่มผู้ขับ</a>
        </div>

        <?PHP
        $sql = "SELECT * FROM tb_driver where delete_data = 0";
        $list = result_array($sql);
        ?>

        <?PHP foreach ($list as $key => $_list) { 
          $Title = "ยืนยันการลบ";
          $Text = "ต้องการลบผู้ขับ ".$_list['driver_title'].$_list['driver_name']." ".$_list['driver_lastname']." หรือไม่ ?";
          $Color = "#d33";
          $Link = "process/delete.php?table=tb_driver&ff=driver_id&id=" . $_list['driver_id'];
          ?>

          <div class="col" style="max-width:350px;">
            <div class="list-driver">
              <div class="row">
                <div class="col-md-12">
                  <img src="uploads/<?= $_list['driver_picture']; ?>" style="width: auto; height: 100px;" alt="">
                  <p>
                    <?= $_list['driver_title']; ?><?= $_list['driver_name']; ?> <?= $_list['driver_lastname']; ?>
                  </p>
                  <p>
                    <?= $_list['driver_telephone']; ?>
                  </p>
                </div>
                <div class="col-md-6 mb-2">
                  <a data-remote="false" data-toggle="modal" data-target="#hrefModal" style="width: 100%;" href="index.php?module=modal&action=car/driver_form&id=<?= $_list['driver_id']; ?>" class="btn btn-sm btn-warning btn-rounded">
                    <i class="fa fa-edit"></i> แก้ไข
                  </a>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-sm btn-danger" style="width: 100%;" onclick="AlertConLink('<?= $Title; ?>', '<?= $Text; ?>', '<?= $Color; ?>', '<?= $Link; ?>')">
                    <i class="fa fa-times"></i> ลบ
                  </button>
                </div>
              </div>
            </div>

          </div>

        <?PHP } ?>

      </div>

    </div>
  </div>

</div>