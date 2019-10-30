<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-wrench"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">แจ้งซ่อม</h1>

      <div class="row d-flex justify-content-center">

        <div class="col-md-8 col-md-offset-2">

          <form action="process/maintenance_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="col-md-12">
              <div class="form-group">
                <label>ประเภท :</label>
                <select name="maintenance_type_id" class="form-control" required>
                  <option disabled selected value="">เลือกประเภท</option>
                  <?PHP
                  $sql = "SELECT * FROM tb_maintenance_type";
                  $maintenance = result_array($sql);
                  ?>
                  <?PHP foreach ($maintenance as $_maintenance) { ?>
                    <option value="<?= $_maintenance['maintenance_type_id']; ?>">
                      <?= $_maintenance['maintenance_type_name']; ?>
                    </option>
                  <?PHP } ?>
                </select>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>รายการ :</label>
                <input type="text" class="form-control" name="maintenance_list" required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>รายละเอียด :</label>
                <textarea name="maintenance_detail" class="form-control" required></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>สถานที่ :</label>
                <input type="text" class="form-control" name="maintenance_place" required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>หมายเหตุ :</label>
                <textarea name="maintenance_msg" class="form-control"></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>
                  รูปภาพ
                  <small style="color: red;">สามารถเลือกได้หลายรูป</small>
                </label>
                <input type="file" multiple name="img[]" accept="image/*">
              </div>
            </div>

            <div class="clearfix"></div>
            <hr>

            <center>
              <button type="submit" class="btn btn-primary btn-lg">บันทึก</button>
            </center>
          </form>

        </div>
      </div>


    </div>
  </div>

</div>