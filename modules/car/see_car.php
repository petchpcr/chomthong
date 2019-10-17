<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-car"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">รายการรถทั้งหมด</h1>

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-md-offset-2">
          <hr>
          <?PHP
          $where = "";
          $search_car_type = 0;
          $search_car_label = "";

          if (isset($_GET['search_car_type'])) {
            $search_car_type = $_GET['search_car_type'];
          }

          if (isset($_GET['search_car_label'])) {
            $search_car_label = $_GET['search_car_label'];
          }

          if ($search_car_type > 0) {
            $where .= " AND car_type_id = '{$search_car_type}'";
          }

          if ($search_car_label != "") {
            $where .= " AND car_licence LIKE '%{$search_car_label}%'";
          }

          ?>
          <form action="">
            <input type="hidden" name="module" value="car">
            <input type="hidden" name="action" value="see_car">
            <div class="row">
              <div class="col-md-6">
                <select name="search_car_type" class="form-control">
                  <option value="0">ทุกประเภท</option>
                  <?PHP
                  $sql = "SELECT * FROM tb_car_type";
                  $car = result_array($sql);
                  ?>
                  <?PHP foreach ($car as $_car) { ?>
                    <option <?= $search_car_type == $_car['car_type_id'] ? "selected" : "" ?> value="<?= $_car['car_type_id']; ?>">
                      <?= $_car['car_type_name']; ?>
                    </option>
                  <?PHP } ?>
                </select>
              </div>
              <div class="col-md-6">
                <input type="text" name="search_car_label" class="form-control" placeholder="เลขทะเบียนรถ" value="<?= $search_car_label; ?>">
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-primary" style="width: 100%; margin-top: 10px">ค้นหา</button>
              </div>
            </div>
          </form>
          <hr>


          <?PHP
          $sql = "SELECT * FROM tb_car where delete_data = 0 {$where}";
          $list = result_array($sql);
          ?>

          <?PHP foreach ($list as $key => $_list) { ?>

            <div class="list-single">
              <div class="row">
                <div class="col-md-3">
                  <img src="uploads/<?= $_list['car_picture']; ?>" class="img-responsive" alt="">
                </div>

                <div class="col-md-9">
                  <h2><?= $_list['car_brand']; ?> <?= $_list['car_model']; ?></h2>
                  <p>
                    <b>ประเภท : </b> <?= get_car_type_name($_list['car_type_id']); ?>
                  </p>
                  <p>
                    <b>สี : </b> <?= $_list['car_color']; ?>
                  </p>
                  <p>
                    <b>ป้ายทะเบียน : </b> <?= $_list['car_licence']; ?>
                  </p>
                  <p>
                    <b>จำนวนที่นั่ง : </b> <?= $_list['car_sit']; ?>
                  </p>
                </div>
              </div>
            </div>
          <?PHP } ?>

        </div>
      </div>


    </div>
  </div>

</div>