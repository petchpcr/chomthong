<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fas fa-signature"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">จัดการลายเซ็น</h1>

      <div class="row d-flex justify-content-center mb-3">
        <div class="col-12 col-md-8 col-lg-6 d-flex">
          <input type="text" id="sign_idcard" class="form-control mr-2 numberOnly" maxlength="13" placeholder="รหัสบัตรประชาชน">
          <button class="btn btn-primary" onclick="user_sign()">ค้นหา</button>
        </div>
      </div>

      <div class="row d-flex justify-content-center">
        <div id="show_user" class="col" style="max-width:350px;" hidden>
          <div class="list-driver">
            <div class="row">
              <div class="col-md-12">
                <img id="img_user" style="width: auto; height: 150px;">
                <div id="sign_name" class="my-4">ชื่อ-นามสกุล</div>
              </div>
              <div class="col-md-6 mb-2">
                <button id="btn_edit_sign" class="btn btn-sm btn-warning" style="width: 100%;">
                  <i class="fa fa-edit"></i> แก้ไขลายเซ็น
                </button>
              </div>
              <div class="col-md-6">
                <button id="btn_del_sign" class="btn btn-sm btn-danger" style="width: 100%;">
                  <i class="fa fa-times"></i> ลบลายเซ็น
                </button>
              </div>
              <div class="col-12 mb-2">
                <button id="btn_add_sign" class="btn btn-sm btn-success" style="width: 100%;">
                  <i class="fas fa-signature"></i> เพิ่มลายเซ็น
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 d-flex justify-content-center">
          <div id="show_sign" class="bg-white card" style="width:500px;height:350px;" hidden>
            
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<?php
 
if (isset($_GET['idcard'])) {
  ?>
  <script type="text/javascript">
    var idcard = "<?PHP echo $_GET['idcard']; ?>";
    user_sign2(idcard);
    $("#sign_idcard").val(idcard);
  </script>
<?php
}
?>