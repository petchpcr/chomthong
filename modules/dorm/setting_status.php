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
      <h1 class="text-center text-truncate h3 mb-4">ปิด-เปิดสถานะการจองห้องพัก</h1>

      <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-md-offset-2">

          <?PHP
          $sql = "SELECT * FROM tb_setting where setting_id = 1";
          $row = row_array($sql);
          ?>


          <div style="border-radius:15px; background: #ffffff; border: 2px solid #f6c23e; padding: 50px 0; text-align: center; font-size: 30px;">
            <?PHP if ($row['setting_value'] == 1) { ?>
              <p style="color: #53c322;">
              <i class="fas fa-toggle-on"></i> สถานะการจองห้องพักถูกเปิดอยู่
              </p>
              <a href="process/update_setting_dorm.php?status=0" class="btn btn-primary"><i class="fas fa-toggle-off"></i> ปิดเดี๋ยวนี้</a>

            <?PHP } else { ?>
              <p style="color: #ff0000;">
              <i class="fas fa-toggle-off"></i> สถานะการจองห้องพักถูกปิดอยู่
              </p>

              <a href="process/update_setting_dorm.php?status=1" class="btn btn-primary"><i class="fas fa-toggle-on"></i> เปิดเดี๋ยวนี้</a>
            <?PHP } ?>
          </div>


        </div>
      </div>
    </div>


  </div>

</div>