<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" role="navigation" id="navbar">

  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['name']; ?></span>
        <i class="fas fa-user-circle" style="font-size:2rem;"></i>
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="index.php?module=home&action=edit_profile">
          <i class="fas fa-user-edit mr-2 text-gray-400"></i>
          แก้ไขข้อมูล
        </a>
        <div class="dropdown-divider mx-2"></div>
        <a class="dropdown-item" href="process/logout.php">
          <i class="fas fa-power-off mr-2 text-gray-400"></i>
          ออกจากระบบ
        </a>
      </div>
    </li>
  </ul>

  <!-- <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <a class="navbar-brand" href="index.php">
      <button class="btn btn-warning">หน้าหลัก</button>
    </a>
  </div>

  <ul class="nav navbar-top-links navbar-right menu-in-top">


    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <p style="float: right; padding: 4px 0 0 10px;">
          [ <?= status($_SESSION['status']); ?> ] <?= $_SESSION['name']; ?>
        </p>

        <i class="fa fa-user fa-2x" style="float: right;"></i>

      </a>

      <ul class="dropdown-menu dropdown-user">
        <li><a href="index.php?module=home&action=edit_profile"><i class="fa fa-gear fa-fw"></i>แก้ไขข้อมูลส่วนตัว</a>
        </li>
        <li class="divider"></li>
        <li><a href="process/logout.php"><i class="fa fa-sign-out fa-fw"></i>ออกจากระบบ</a>
        </li>
      </ul>
    </li>
  </ul> -->

</nav>