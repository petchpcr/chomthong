<?PHP
if ($_SESSION['status'] == 0 && $_SESSION['title'] != 'นางสาว') {
  echo "<script>window.location.href='index.php';</script>";
}
?>
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
      <h1 class="text-center text-truncate h3 mb-4">จัดการหอพัก</h1>

      <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">
          <div class="text-right mb-3">
            <a href="index.php?module=modal&action=dorm/dorm_form" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
              <i class="fa fa-plus"></i>
              เพิ่มข้อมูล</a>
          </div>


          <?PHP
          $sql = "SELECT * FROM tb_dorm where delete_data = 0";
          $list = result_array($sql);
          ?>

          <?PHP foreach ($list as $key => $_list) {
            $Title = "ยืนยันการลบ";
            $Text = "ต้องการลบ " . $_list['dorm_name'] . " หรือไม่ ?";
            $Color = "#d33";
            $Link = "process/delete.php?table=tb_dorm&ff=dorm_id&id=" . $_list['dorm_id'];
            ?>

            <div class="list-single">
              <div class="row">
                <div class="col-md-3">
                  <img src="uploads/<?= $_list['dorm_picture']; ?>" class="img-responsive" alt="">
                </div>

                <div class="col-md-6">
                  <h2><?= $_list['dorm_name']; ?></h2>
                  <p>
                    <b>ราคา : </b> <?= number_format($_list['dorm_price']); ?>
                  </p>
                  <p>
                    <b>รายละเอียด : </b> <?= $_list['dorm_detail']; ?>
                  </p>
                  <p>
                    <b>สิทธิการเข้าพัก : </b> <?= dorm_position($_list['dorm_position']); ?>
                  </p>
                </div>
                <div class="col-md-3">
                  <a style="width: 100%; margin-top: 10px" href="index.php?module=dorm&action=list_dorm_room&dorm_id=<?= $_list['dorm_id']; ?>" class="btn btn-info">จัดการห้องพัก</a>

                  <a data-remote="false" data-toggle="modal" data-target="#hrefModal" style="width: 100%; margin-top: 15px" href="index.php?module=modal&action=dorm/dorm_form&id=<?= $_list['dorm_id']; ?>" class="btn btn-sm btn-warning btn-rounded">
                    <i class="fa fa-edit"></i> แก้ไข
                  </a>

                  <button class="btn btn-sm btn-danger" style="width: 100%; margin-top: 15px" onclick="AlertConLink('<?= $Title; ?>', '<?= $Text; ?>', '<?= $Color; ?>', '<?= $Link; ?>')">
                    <i class="fa fa-times"></i> ลบ
                  </button>
                </div>
              </div>
            </div>
          <?PHP } ?>

        </div>
      </div>
    </div>


  </div>
</div>