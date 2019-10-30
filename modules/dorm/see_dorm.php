<?PHP
$position = $_SESSION['status'];

if ($_SESSION['title'] == 'นาย') {
  $gender = 1;
}
else if ($_SESSION['title'] == 'นาง' || $_SESSION['title'] == 'นางสาว') {
  $gender = 2;
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
      <h1 class="text-center text-truncate h3 mb-4">ข้อมูลห้องพัก</h1>

      <div class="row d-flex justify-content-center">

        <div class="col-md-8 col-md-offset-2">

          <?PHP
          $sql = "SELECT * FROM tb_dorm where delete_data = 0";
          $list = result_array($sql);
          ?>

          <?PHP foreach ($list as $key => $_list) { ?>

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
                  <p>
                    <b>ประเภท : </b> <?= dorm_gender($_list['dorm_gender']); ?>
                  </p>
                </div>
                <div class="col-md-3">
                  <a style="width: 100%; margin-top: 10px" href="index.php?module=dorm&action=see_dorm_room&dorm_id=<?= $_list['dorm_id']; ?>" class="btn btn-info">ดูห้องพัก</a>
                </div>
              </div>
            </div>
          <?PHP } ?>

        </div>
      </div>
    </div>
  </div>


</div>

</div>