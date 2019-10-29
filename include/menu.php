<ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
      <img class="img-fluid" src="assets/img/rmutl_logo.png" style="width: 1rem;">
    </div>
    <div class="sidebar-brand-text mx-3">CHOMTHONG</div>
  </a>
  <hr class="sidebar-divider my-0">

  <!-- แอดมิน -->
  <?php if ($_SESSION['status'] == 4) { ?>

    <li class="nav-item">
      <a class="nav-link" href="https://bala.rmutl.ac.th/jomthong/" target="_blank">
        <i class="fa fa-list fa-fw"></i>
        <span>จัดการหน้าเว็บไซต์</span>
      </a>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'building' ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?module=building&action=list_building">
        <i class="fas fa-building"></i>
        <span>จัดการอาคาร</span></a>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'user' ? 'active' : ''; ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user_menu" aria-expanded="true" aria-controls="user_menu">
        <i class="fa fa-user fa-fw"></i>
        <span>จัดการผู้ใช้</span>
      </a>
      <div id="user_menu" class="collapse <?= $_GET['module'] == 'user' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $_GET['action'] == 'list_manager' ? 'active' : ''; ?>" href="index.php?module=user&action=list_manager">จัดการผู้บริหาร</a>
          <a class="collapse-item <?= $_GET['action'] == 'list_personnel' ? 'active' : ''; ?>" href="index.php?module=user&action=list_personnel">จัดการบุคลากร</a>
          <a class="collapse-item <?= $_GET['action'] == 'list_teacher' ? 'active' : ''; ?>" href="index.php?module=user&action=list_teacher">จัดการอาจารย์</a>
          <a class="collapse-item <?= $_GET['action'] == 'list_student' ? 'active' : ''; ?>" href="index.php?module=user&action=list_student">จัดการนักศึกษา</a>
        </div>
      </div>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'sign' ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?module=sign&action=sign_form">
        <i class="fas fa-signature"></i>
        <span>จัดการลายเซ็น</span>
      </a>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'major' ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?module=major&action=list_major">
        <i class="fas fa-graduation-cap"></i>
        <span>จัดการหลักสูตร</span>
      </a>
    </li>

    <!-- ผู้บริหาร -->
  <?php } else if ($_SESSION['status'] == 3) { ?>

    <li class="nav-item <?= $_GET['action'] == 'appove_maintenance' || $_GET['action'] == 'appove_maintenance_detail' ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?module=maintenance&action=appove_maintenance">
        <i class="fas fa-wrench"></i>
        <span>อนุมัติการซ่อม</span></a>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'equipment' ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?module=equipment&action=appove_equipment_lend">
        <i class="fas fa-archive"></i>
        <span>อนุมัติครุภัณฑ์</span></a>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'report' ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?module=report&action=report_dorm">
        <i class="fas fa-chart-bar"></i>
        <span>รายงาน</span></a>
    </li>

    <!-- อาจารย์ -->
  <?php } else if ($_SESSION['status'] == 2) { ?>

    <li class="nav-item <?= $_GET['module'] == 'dorm' ? 'active' : ''; ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dorm_menu" aria-expanded="true" aria-controls="dorm_menu">
        <i class="fas fa-home"></i>
        <span>จัดการหอพัก</span>
      </a>
      <div id="dorm_menu" class="collapse <?= $_GET['module'] == 'dorm' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $_GET['action'] == 'see_dorm' || $_GET['action'] == 'see_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=see_dorm">ข้อมูลห้องพักทั้งหมด</a>
          <a class="collapse-item <?= $_GET['action'] == 'my_dorm' ? 'active' : ''; ?>" href="index.php?module=dorm&action=my_dorm">ห้องพักของฉัน</a>
          <a class="collapse-item <?= $_GET['action'] == 'booking'  || $_GET['action'] == 'booking_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=booking">จองห้องพัก</a>
        </div>
      </div>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'car' ? 'active' : ''; ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#car_menu" aria-expanded="true" aria-controls="car_menu">
        <i class="fas fa-car"></i>
        <span>จัดการจองรถ</span>
      </a>
      <div id="car_menu" class="collapse <?= $_GET['module'] == 'car' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $_GET['action'] == 'see_car' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car">รายการรถทั้งหมด</a>
          <a class="collapse-item <?= $_GET['action'] == 'see_driver' ? 'active' : ''; ?>" href="index.php?module=car&action=see_driver">รายการคนขับรถทั้งหมด</a>
          <hr class="my-1 mx-2">
          <a class="collapse-item <?= $_GET['action'] == 'select_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=select_car_lend">จองรถ</a>
          <a class="collapse-item <?= $_GET['action'] == 'my_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=my_car_lend">การจองรถของฉัน</a>
          <hr class="my-1 mx-2">
          <a class="collapse-item <?= $_GET['action'] == 'see_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_lend">รายการจองรถ</a>
          <a class="collapse-item <?= $_GET['action'] == 'see_car_land_all' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_land_all">ประวัติการจองทั้งหมด</a>
        </div>
      </div>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'maintenance' ? 'active' : ''; ?>">
      <a class="nav-link" href="index.php?module=maintenance&action=list_maintenance">
        <i class="fas fa-wrench"></i>
        <span>แจ้งซ่อม</span></a>
    </li>

    <li class="nav-item <?= $_GET['module'] == 'equipment' ? 'active' : ''; ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipment_menu" aria-expanded="true" aria-controls="equipment_menu">
        <i class="fas fa-archive"></i>
        <span>จัดการครุภัณฑ์</span>
      </a>
      <div id="equipment_menu" class="collapse <?= $_GET['module'] == 'equipment' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item <?= $_GET['action'] == 'list_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=list_equipment_lend">ยืมครุภัณฑ์</a>
          <a class="collapse-item <?= $_GET['action'] == 'my_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=my_equipment_lend">การยืมของฉัน</a>
          <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend">รายการยืมครุภัณฑ์</a>
          <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend_all' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend_all">ประวัติการยืมทั้งหมด</a>
        </div>
      </div>
    </li>

    <!-- บุคลากร -->
  <?php } else if ($_SESSION['status'] == 1) { ?>

    <!-- บุคลากรฝ่ายยุทธศาสตร์และแผน -->
    <?PHP if ($_SESSION['position'] == 1) { ?>

      <li class="nav-item <?= $_GET['module'] == 'dorm' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dorm_menu" aria-expanded="true" aria-controls="dorm_menu">
          <i class="fas fa-home"></i>
          <span>จัดการหอพัก</span>
        </a>
        <div id="dorm_menu" class="collapse <?= $_GET['module'] == 'dorm' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'see_dorm' || $_GET['action'] == 'see_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=see_dorm">ข้อมูลห้องพักทั้งหมด</a>
            <a class="collapse-item <?= $_GET['action'] == 'list_dorm' || $_GET['action'] == 'list_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=list_dorm">จัดการหอพัก</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_dorm' || $_GET['action'] == '' ? 'active' : ''; ?>" href="index.php?module=dorm&action=my_dorm">ห้องพักของฉัน</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'setting_status' ? 'active' : ''; ?>" href="index.php?module=dorm&action=setting_status">ปิด-เปิดการจองหอพัก</a>
            <a class="collapse-item <?= $_GET['action'] == 'booking' || $_GET['action'] == 'booking_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=booking">จองห้องพัก</a>
            <a class="collapse-item <?= $_GET['action'] == 'appove_roomer' ? 'active' : ''; ?>" href="index.php?module=dorm&action=appove_roomer">อนุมัติการจอง</a>

            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'dorm_payment' || $_GET['action'] == 'dorm_payment_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=dorm_payment">จัดการค่าใช้จ่าย</a>
            <a class="collapse-item <?= $_GET['action'] == 'appove_dorm_payment' ? 'active' : ''; ?>" href="index.php?module=dorm&action=appove_dorm_payment">ชำระเงิน</a>

            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'appove_roomer_out' ? 'active' : ''; ?>" href="index.php?module=dorm&action=appove_roomer_out">อนุมัติการแจ้งออกหอพัก</a>
            <a class="collapse-item <?= $_GET['action'] == 'roomer_out' ? 'active' : ''; ?>" href="index.php?module=dorm&action=roomer_out">รอออกหอพัก</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'car' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#car_menu" aria-expanded="true" aria-controls="car_menu">
          <i class="fas fa-car"></i>
          <span>จัดการจองรถ</span>
        </a>
        <div id="car_menu" class="collapse <?= $_GET['module'] == 'car' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'see_car' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car">รายการรถทั้งหมด</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_driver' ? 'active' : ''; ?>" href="index.php?module=car&action=see_driver">รายการคนขับรถทั้งหมด</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'select_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=select_car_lend">จองรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=my_car_lend">การจองรถของฉัน</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'see_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_lend">รายการจองรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_car_land_all' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_land_all">ประวัติการจองทั้งหมด</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'maintenance' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?module=maintenance&action=list_maintenance">
          <i class="fas fa-wrench"></i>
          <span>แจ้งซ่อม</span></a>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'equipment' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipment_menu" aria-expanded="true" aria-controls="equipment_menu">
          <i class="fas fa-archive"></i>
          <span>จัดการครุภัณฑ์</span>
        </a>
        <div id="equipment_menu" class="collapse <?= $_GET['module'] == 'equipment' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'list_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=list_equipment_lend">ยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=my_equipment_lend">การยืมของฉัน</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend">รายการยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend_all' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend_all">ประวัติการยืมทั้งหมด</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'report' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?module=report&action=report_dorm">
          <i class="fas fa-chart-bar"></i>
          <span>รายงาน</span></a>
      </li>

      <!-- บุคลากรฝ่ายอาคารสถานที่ -->
    <?PHP } else if ($_SESSION['position'] == 2) { ?>

      <li class="nav-item <?= $_GET['module'] == 'dorm' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dorm_menu" aria-expanded="true" aria-controls="dorm_menu">
          <i class="fas fa-home"></i>
          <span>จัดการหอพัก</span>
        </a>
        <div id="dorm_menu" class="collapse <?= $_GET['module'] == 'dorm' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'see_dorm' || $_GET['action'] == 'see_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=see_dorm">ข้อมูลห้องพักทั้งหมด</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_dorm' ? 'active' : ''; ?>" href="index.php?module=dorm&action=my_dorm">ห้องพักของฉัน</a>
            <a class="collapse-item <?= $_GET['action'] == 'booking'  || $_GET['action'] == 'booking_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=booking">จองห้องพัก</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'car' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#car_menu" aria-expanded="true" aria-controls="car_menu">
          <i class="fas fa-car"></i>
          <span>จัดการจองรถ</span>
        </a>
        <div id="car_menu" class="collapse <?= $_GET['module'] == 'car' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'list_car' ? 'active' : ''; ?>" href="index.php?module=car&action=list_car">จัดการรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'list_driver' ? 'active' : ''; ?>" href="index.php?module=car&action=list_driver">จัดการพนักงานขับรถ</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'select_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=select_car_lend">จองรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=my_car_lend">การจองรถของฉัน</a>
            <a class="collapse-item <?= $_GET['action'] == 'appove_car' ? 'active' : ''; ?>" href="index.php?module=car&action=appove_car">อนุมัติการจองรถ</a>
            <!-- <a class="collapse-item <?= $_GET['action'] == 'car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=car_lend">จัดการจองรถ</a> -->
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'get_car' ? 'active' : ''; ?>" href="index.php?module=car&action=get_car">รับรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'return_car' ? 'active' : ''; ?>" href="index.php?module=car&action=return_car">คืนรถ</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'see_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_lend">รายการจองรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_car_land_all' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_land_all">ประวัติการจองทั้งหมด</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'maintenance' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#maintenance_menu" aria-expanded="true" aria-controls="maintenance_menu">
          <i class="fas fa-wrench"></i>
          <span>จัดการแจ้งซ่อม</span>
        </a>
        <div id="maintenance_menu" class="collapse <?= $_GET['module'] == 'maintenance' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'list_maintenance' || $_GET['action'] == 'maintenance_form' ? 'active' : ''; ?>" href="index.php?module=maintenance&action=list_maintenance">แจ้งซ่อม</a>
            <a class="collapse-item <?= $_GET['action'] == 'confirm_maintenance' ? 'active' : ''; ?>" href="index.php?module=maintenance&action=confirm_maintenance">รับเรื่องแจ้งซ่อม</a>
            <a class="collapse-item <?= $_GET['action'] == 'maintenance_send' ? 'active' : ''; ?>" href="index.php?module=maintenance&action=maintenance_send">ทำเรื่องส่งซ่อม</a>
            <a class="collapse-item <?= $_GET['action'] == 'maintenance_send_finish' ? 'active' : ''; ?>" href="index.php?module=maintenance&action=maintenance_send_finish">แจ้งซ่อมสำเร็จ</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'equipment' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipment_menu" aria-expanded="true" aria-controls="equipment_menu">
          <i class="fas fa-archive"></i>
          <span>จัดการครุภัณฑ์</span>
        </a>
        <div id="equipment_menu" class="collapse <?= $_GET['module'] == 'equipment' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'list_equipment' ? 'active' : ''; ?>" href="index.php?module=equipment&action=list_equipment">จัดการครุภัณฑ์</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'list_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=list_equipment_lend">ยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'get_equipment' ? 'active' : ''; ?>" href="index.php?module=equipment&action=get_equipment">รับครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'return_equipment' ? 'active' : ''; ?>" href="index.php?module=equipment&action=return_equipment">คืนครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=my_equipment_lend">การยืมของฉัน</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend">รายการยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend_all' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend_all">ประวัติการยืมทั้งหมด</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'user' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?module=user&action=list_student">
          <i class="fas fa-user-graduate"></i>
          <span>จัดการข้อมูลนักศึกษา</span></a>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'report' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?module=report&action=report_booking_car">
          <i class="fas fa-chart-bar"></i>
          <span>รายงาน</span></a>
      </li>

      <!-- บุคลากรทั่วไป -->
    <?PHP } else if ($_SESSION['position'] == 3) { ?>

      <li class="nav-item <?= $_GET['module'] == 'dorm' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dorm_menu" aria-expanded="true" aria-controls="dorm_menu">
          <i class="fas fa-home"></i>
          <span>จัดการหอพัก</span>
        </a>
        <div id="dorm_menu" class="collapse <?= $_GET['module'] == 'dorm' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'see_dorm' || $_GET['action'] == 'see_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=see_dorm">ข้อมูลห้องพักทั้งหมด</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_dorm' ? 'active' : ''; ?>" href="index.php?module=dorm&action=my_dorm">ห้องพักของฉัน</a>
            <a class="collapse-item <?= $_GET['action'] == 'booking'  || $_GET['action'] == 'booking_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=booking">จองห้องพัก</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'car' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#car_menu" aria-expanded="true" aria-controls="car_menu">
          <i class="fas fa-car"></i>
          <span>จัดการจองรถ</span>
        </a>
        <div id="car_menu" class="collapse <?= $_GET['module'] == 'car' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'see_car' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car">รายการรถทั้งหมด</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_driver' ? 'active' : ''; ?>" href="index.php?module=car&action=see_driver">รายการคนขับรถทั้งหมด</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'select_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=select_car_lend">จองรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=my_car_lend">การจองรถของฉัน</a>
            <hr class="my-1 mx-2">
            <a class="collapse-item <?= $_GET['action'] == 'see_car_lend' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_lend">รายการจองรถ</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_car_land_all' ? 'active' : ''; ?>" href="index.php?module=car&action=see_car_land_all">ประวัติการจองทั้งหมด</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'maintenance' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?module=maintenance&action=list_maintenance">
          <i class="fas fa-wrench"></i>
          <span>แจ้งซ่อม</span></a>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'equipment' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipment_menu" aria-expanded="true" aria-controls="equipment_menu">
          <i class="fas fa-archive"></i>
          <span>จัดการครุภัณฑ์</span>
        </a>
        <div id="equipment_menu" class="collapse <?= $_GET['module'] == 'equipment' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'list_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=list_equipment_lend">ยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=my_equipment_lend">การยืมของฉัน</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend">รายการยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend_all' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend_all">ประวัติการยืมทั้งหมด</a>
          </div>
        </div>
      </li>

    <?PHP } ?>

    <!-- นักศึกษา -->
    <?php } else if ($_SESSION['status'] == 0) {
      if ($_SESSION['id'] == "S-1") { ?>

      <li class="nav-item <?= $_GET['module'] == 'maintenance' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?module=maintenance&action=list_maintenance">
          <i class="fas fa-wrench"></i>
          <span>นักศึกษาแจ้งซ่อม</span></a>
      </li>

    <?php } else { ?>

      <li class="nav-item <?= $_GET['module'] == 'dorm' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dorm_menu" aria-expanded="true" aria-controls="dorm_menu">
          <i class="fas fa-home"></i>
          <span>จัดการหอพัก</span>
        </a>
        <div id="dorm_menu" class="collapse <?= $_GET['module'] == 'dorm' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'see_dorm' || $_GET['action'] == 'see_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=see_dorm">ข้อมูลห้องพักทั้งหมด</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_dorm' ? 'active' : ''; ?>" href="index.php?module=dorm&action=my_dorm">ห้องพักของฉัน</a>
            <a class="collapse-item <?= $_GET['action'] == 'booking'  || $_GET['action'] == 'booking_dorm_room' ? 'active' : ''; ?>" href="index.php?module=dorm&action=booking">จองห้องพัก</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'equipment' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipment_menu" aria-expanded="true" aria-controls="equipment_menu">
          <i class="fas fa-archive"></i>
          <span>จัดการครุภัณฑ์</span>
        </a>
        <div id="equipment_menu" class="collapse <?= $_GET['module'] == 'equipment' ? 'show' : ''; ?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $_GET['action'] == 'list_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=list_equipment_lend">ยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'my_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=my_equipment_lend">การยืมของฉัน</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend">รายการยืมครุภัณฑ์</a>
            <a class="collapse-item <?= $_GET['action'] == 'see_equipment_lend_all' ? 'active' : ''; ?>" href="index.php?module=equipment&action=see_equipment_lend_all">ประวัติการยืมทั้งหมด</a>
          </div>
        </div>
      </li>

      <li class="nav-item <?= $_GET['module'] == 'alert_report' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php?module=alert_report&action=my_alert_report">
          <i class="fas fa-file-alt"></i>
          <span>คำร้องเรียน</span></a>
      </li>

  <?PHP }
  } ?>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>