<!-- <div class="status-index text-right"> -->
<div class="d-flex justify-content-center py-2 bg-dark">
  <div class="col-12 col-md-10 col-lg-9 col-xl-8 text-right ">
    <span class="text-white">[ <?= status($_SESSION['status']); ?> ] <?= $_SESSION['name']; ?></span>
    <a href="index.php?module=home&action=edit_profile" class="btn btn-info"><i class="fas fa-user-edit mr-1"></i>แก้ไขข้อมูล</a>
    <a href="process/logout.php" class="btn btn-danger"><i class="fas fa-power-off mr-1"></i>ออกจากระบบ</a>
  </div>
</div>
<div class="container">
  <div class="row index-menu mt-5 p-5">

    <!-- แอดมิน -->
    <?php if ($_SESSION['status'] == 4) { ?>

      <div class="col text-center" style="display: block">
        <div>
          <a href="https://bala.rmutl.ac.th/jomthong/" target="_blank" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-list"></i>
          </a>
        </div>
        <div class="mb-4 text-white">จัดการหน้าเว็บไซต์</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=building&action=list_building" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-home"></i>
          </a>
        </div>
        <div class="mb-4 text-white">จัดการอาคาร</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=user&action=list_manager" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-user"></i>
          </a>
        </div>
        <div class="mb-4 text-white">จัดการผู้ใช้</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=sign&action=sign_form" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fas fa-signature"></i>
          </a>
        </div>
        <div class="mb-4 text-white">จัดการลายเซ็น</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=major&action=list_major" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-list-alt"></i>
          </a>
        </div>
        <div class="mb-4 text-white">จัดการหลักสูตร</div>
      </div>

      <!-- ผู้บริหาร -->
    <?php } elseif ($_SESSION['status'] == 3) { ?>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=maintenance&action=appove_maintenance" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fas fa-wrench"></i>
            <?PHP
              $sql = "SELECT * FROM tb_maintenance a inner join tb_maintenance_type b on a.maintenance_type_id = b.maintenance_type_id where maintenance_status = 2 order by maintenance_status asc  ";
              $list = result_array($sql);
              $count = count($list);
              ?>
            <?PHP if ($count > 0) { ?>
              <div class="bg_notify">
                <div class="num_notify"><?= $count; ?></div>
              </div>
            <?PHP } ?>
          </a>
        </div>
        <div class="mb-4 text-white">อนุมัติแจ้งซ่อม</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=equipment&action=appove_equipment_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fas fa-archive"></i>
            <?PHP
              $sql = "SELECT * FROM tb_equipment_lend z inner join tb_equipment a on z.equipment_id = a.equipment_id inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where equipment_lend_status = 0 order by equipment_lend_status asc";
              $list = result_array($sql);
              $count = count($list);
              ?>
            <?PHP if ($count > 0) { ?>
              <div class="bg_notify">
                <div class="num_notify"><?= $count; ?></div>
              </div>
            <?PHP } ?>
          </a>
        </div>
        <div class="mb-4 text-white">อนุมัติครุภัณฑ์</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=report&action=report_dorm" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-bar-chart-o"></i>
          </a>
        </div>
        <div class="mb-4 text-white">รายงาน</div>
      </div>

      <!-- อาจารย์ -->
    <?php } elseif ($_SESSION['status'] == 2) { ?>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=dorm&action=my_dorm" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-home"></i>
          </a>
        </div>
        <div class="mb-4 text-white">จัดการหอพัก</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=car&action=select_car_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-car"></i>
          </a>
        </div>
        <div class="mb-4 text-white">จองรถ</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=maintenance&action=list_maintenance" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-wrench"></i>
          </a>
        </div>
        <div class="mb-4 text-white">แจ้งซ่อม</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=equipment&action=list_equipment_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fas fa-archive"></i>
          </a>
        </div>
        <div class="mb-4 text-white">ยืมครุภัณฑ์</div>
      </div>

      <!-- บุคลากร -->
    <?php } elseif ($_SESSION['status'] == 1) { ?>

      <!-- บุคลากรฝ่ายยุทธศาสตร์และแผน -->
      <?PHP if ($_SESSION['position'] == 1) { ?>

        <div class="col text-center" style="display: block">
          <div>
            <?PHP
                $sql = "SELECT * FROM tb_roomer a inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id inner join tb_dorm d on b.dorm_id = d.dorm_id where a.roomer_status = 0 order by roomer_status asc  ";
                $list = result_array($sql);
                $count = count($list);
                ?>
            <?PHP if ($count > 0) { ?>
              <a href="index.php?module=dorm&action=appove_roomer" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <?PHP } else { ?>
                <a href="index.php?module=dorm&action=my_dorm" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">

                <?PHP } ?>
                <i class="fa fa-home"></i>
                <?PHP if ($count > 0) { ?>
                  <div class="bg_notify">
                    <div class="num_notify"><?= $count; ?></div>
                  </div>
                <?PHP } ?>
                </a>
          </div>
          <div class="mb-4 text-white">จัดการจองห้องพัก</div>
        </div>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=car&action=select_car_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fa fa-car"></i>
            </a>
          </div>
          <div class="mb-4 text-white">จองรถ</div>
        </div>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=maintenance&action=list_maintenance" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fa fa-wrench"></i>
            </a>
          </div>
          <div class="mb-4 text-white">แจ้งซ่อม</div>
        </div>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=equipment&action=list_equipment_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fas fa-archive"></i>
            </a>
          </div>
          <div class="mb-4 text-white">ยืมครุภัณฑ์</div>
        </div>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=report&action=report_dorm" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fa fa-bar-chart-o"></i>
            </a>
          </div>
          <div class="mb-4 text-white">รายงาน</div>
        </div>

        <!-- บุคลากรฝ่ายอาคารสถานที่ -->
      <?PHP } elseif ($_SESSION['position'] == 2) { ?>

        <div class="col text-center" style="display: block">
          <a href="index.php?module=dorm&action=my_dorm" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-home"></i>
          </a>
          <div class="mb-4 text-white">จองห้องพัก</div>
        </div>

        <div class="col text-center" style="display: block">
          <?PHP
              $sql = "SELECT * FROM tb_car_lend a inner join tb_car b on a.car_id = b.car_id inner join tb_driver d on a.driver_id = d.driver_id where car_lend_status = 0 order by car_lend_status asc  ";
              $list = result_array($sql);
              $count = count($list);

              if ($count > 0) { ?>
            <a href="index.php?module=car&action=appove_car" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <?PHP } else { ?>
              <a href="index.php?module=car&action=select_car_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <?PHP }  ?>
              <i class="fa fa-car"></i>
              <?PHP if ($count > 0) { ?>
                <div class="bg_notify">
                  <div class="num_notify"><?= $count; ?></div>
                </div>
              <?PHP }  ?>
              </a>
              <div class="mb-4 text-white">จัดการจองรถ</div>
        </div>

        <div class="col text-center" style="display: block">
          <?PHP
              $sql = "SELECT * FROM tb_maintenance where maintenance_status = 0";
              $list = result_array($sql);
              $count = count($list);

              if ($count > 0) { ?>
            <a href="index.php?module=maintenance&action=confirm_maintenance" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <?PHP } else { ?>
              <a href="index.php?module=maintenance&action=list_maintenance" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <?PHP }  ?>
              <i class="fa fa-wrench"></i>
              <?PHP if ($count > 0) { ?>
                <div class="bg_notify">
                  <div class="num_notify"><?= $count; ?></div>
                </div>
              <?PHP }  ?>
              </a>
              <div class="mb-4 text-white">จัดการแจ้งซ่อม</div>
        </div>

        <div class="col text-center" style="display: block">
          <a href="index.php?module=equipment&action=list_equipment" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fas fa-archive"></i>
          </a>
          <div class="mb-4 text-white">จัดการครุภัณฑ์</div>
        </div>

        <div class="col text-center" style="display: block">
          <a href="index.php?module=user&action=list_student" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-users"></i>
          </a>
          <div class="mb-4 text-white">จัดการข้อมูลนักศึกษา</div>
        </div>

        <div class="col text-center" style="display: block">
          <a href="index.php?module=report&action=report_booking_car" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-bar-chart-o"></i>
          </a>
          <div class="mb-4 text-white">รายงาน</div>
        </div>

        <!-- บุคลากรทั่วไป -->
      <?PHP } elseif ($_SESSION['position'] == 3) { ?>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=dorm&action=my_dorm" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fa fa-home"></i>
            </a>
          </div>
          <div class="mb-4 text-white">จัดการหอพัก</div>
        </div>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=car&action=select_car_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fa fa-car"></i>
            </a>
          </div>
          <div class="mb-4 text-white">จองรถ</div>
        </div>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=maintenance&action=list_maintenance" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fa fa-wrench"></i>
            </a>
          </div>
          <div class="mb-4 text-white">แจ้งซ่อม</div>
        </div>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=equipment&action=list_equipment_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fas fa-archive"></i>
            </a>
          </div>
          <div class="mb-4 text-white">ยืมครุภัณฑ์</div>
        </div>

      <?PHP } ?>

      <!-- นักศึกษา -->
      <?php } elseif ($_SESSION['status'] == 0) {
        if ($_SESSION['title'] == "นางสาว") { ?>

        <div class="col text-center" style="display: block">
          <div>
            <a href="index.php?module=dorm&action=my_dorm" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
              <i class="fa fa-home"></i>
            </a>
          </div>
          <div class="mb-4 text-white">จัดการหอพัก</div>
        </div>

      <?php } ?>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=maintenance&action=list_maintenance" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-wrench"></i>
          </a>
        </div>
        <div class="mb-4 text-white">แจ้งซ่อม</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=equipment&action=list_equipment_lend" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fas fa-archive"></i>
          </a>
        </div>
        <div class="mb-4 text-white">ยืมครุภัณฑ์</div>
      </div>

      <div class="col text-center" style="display: block">
        <div>
          <a href="index.php?module=alert_report&action=my_alert_report" class="btn btn-primary btn-circle btn-jumbo shadow-lg m-4 border">
            <i class="fa fa-file-text"></i>
          </a>
        </div>
        <div class="mb-4 text-white">คำร้องเรียน</div>
      </div>

    <?php } else { ?>
      <h2 class="text-center" style="padding-top: 100px;">คุณไม่มีสิทธิ์ใช้งานระบบ กรุณาติดต่อผู้ดูแลระบบ</h2>
    <?php } ?>

  </div>
</div>