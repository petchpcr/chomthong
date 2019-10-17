<ul class="nav nav-tabs">
    <?PHP if ($_SESSION['status'] == 3 || ($_SESSION['status'] == 1 && $_SESSION['position'] == 1)) { ?>
        <li <?= $_GET['action'] == 'report_dorm' ? "class='active'" : ""; ?>>
            <a href="index.php?module=report&action=report_dorm">การชำระเงินค่าหอพัก</a>
        </li>
    <?PHP } ?>
    <?PHP if ($_SESSION['status'] == 3 || ($_SESSION['status'] == 1 && $_SESSION['position'] == 2)) { ?>
        <li <?= $_GET['action'] == 'report_booking_car' ? "class='active'" : ""; ?>>
            <a href="index.php?module=report&action=report_booking_car">การจองรถ</a>
        </li>
    <?PHP } ?>
    <?PHP if ($_SESSION['status'] == 3 || ($_SESSION['status'] == 1 && $_SESSION['position'] == 2)) { ?>
        <li <?= $_GET['action'] == 'report_equipment' ? "class='active'" : ""; ?>>
            <a href="index.php?module=report&action=report_equipment">การยืมครุภัณฑ์</a>
        </li>
    <?PHP } ?>
    <?PHP if ($_SESSION['status'] == 3 || ($_SESSION['status'] == 1 && $_SESSION['position'] == 2)) { ?>
        <li <?= $_GET['action'] == 'report_maintenance' ? "class='active'" : ""; ?>>
            <a href="index.php?module=report&action=report_maintenance">การแจ้งซ่อม</a>
        </li>
    <?PHP } ?>
    <?PHP if ($_SESSION['status'] == 3) { ?>
        <li <?= $_GET['action'] == 'report_alert_report' ? "class='active'" : ""; ?>>
            <a href="index.php?module=report&action=report_alert_report">คำร้องนักศึกษา</a>
        </li>
    <?PHP } ?>
</ul>

