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
      <h1 class="text-center text-truncate h3 mb-4">พนักงานขับรถ</h1>

      <div class="row">

        <?PHP
        $sql = "SELECT * FROM tb_driver where delete_data = 0";
        $list = result_array($sql);
        ?>

        <?PHP foreach ($list as $key => $_list) { ?>

          <div class="col" style="max-width:300px;">
            <div class="list-driver">
              <div class="col-md-12">
                <img src="uploads/<?= $_list['driver_picture']; ?>" style="width: auto; height: 100px;" alt="">
                <p>
                  <?= $_list['driver_title']; ?><?= $_list['driver_name']; ?> <?= $_list['driver_lastname']; ?>
                </p>
                <p>
                  <?= $_list['driver_telephone']; ?>
                </p>
              </div>
            </div>


          </div>

        <?PHP } ?>

      </div>

    </div>
  </div>

</div>