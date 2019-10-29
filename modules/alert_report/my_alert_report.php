<?PHP
if ($_SESSION['id'] == 'S-1') {
  echo "<script>window.location.href='index.php'</script>";
}
?>
<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-file-text"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3">คำร้องเรียน</h1>
      <div class="text-center">
        <small style="color: red;">คำร้องนี้มีแต่ผู้บริหารเห็นเท่านั้นทุกอย่างจะเก็บเป็นความลับ</small>
      </div>
      <div class="row">

        <div class="col-lg-12">
          <div class="text-right mb-3">
            <a href="index.php?module=modal&action=alert_report/alert_report_form" class="btn btn-primary" data-remote="false" data-toggle="modal" data-target="#hrefModal">
              <i class="fa fa-plus"></i>
              ส่งคำร้องเรียน</a>
          </div>



          <?PHP
          $reportder_id = check_session('id');
          $sql = "SELECT * FROM tb_report where reportder_id = '{$reportder_id}'";
          $list = result_array($sql);
          ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="table-js">
              <thead>
                <tr>
                  <th width="50" class="text-center">ลำดับ</th>
                  <th class="text-center">หัวข้อ</th>
                  <th class="text-center">รายละเอียด</th>
                  <th class="text-center">วันที่</th>
                </tr>
              </thead>
              <tbody>
                <?PHP foreach ($list as $key => $_list) { ?>
                  <tr>
                    <td class="text-center"><?= $key + 1; ?></td>
                    <td class="text-center"><?= $_list['report_topic']; ?></td>
                    <td class="text-left"><?= $_list['report_detail']; ?></td>
                    <td class="text-center"><?= $_list['report_date']; ?></td>
                  </tr>
                <?PHP } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>

  </div>