<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบริหารจัดการ</title>
  <script src="assets/plugins/jquery/jquery.js"></script>
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
  <script src="assets/js/sweetalert2.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#username").keypress(function(event) {
        if (event.which == 13) {
          $("#password").focus();
        }
      });

      $("#password").keypress(function(event) {
        if (event.which == 13) {
          check_login();
        }
      });
    });

    function check_login() {
      var user = $("#username").val();
      var pass = $("#password").val();

      var data = {
        'user': user,
        'pass': pass,
        'STATUS': 'check_logins'
      };
      senddata(JSON.stringify(data));
    }

    // display
    function senddata(data) {
      var form_data = new FormData();
      form_data.append("DATA", data);
      var URL = 'process/check_login.php';
      $.ajax({
        url: URL,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result) {
          try {
            var temp = $.parseJSON(result);
          } catch (e) {
            console.log('Error#542-decode error');
          }

          if (temp["status"] == 'success') {
            swal({
              title: 'เข้าสู่ระบบสำเร็จ',
              text: "",
              type: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              timer: 1000,
              confirmButtonText: 'Ok',
              showConfirmButton: false
            }).then(function() {
              window.location.href = 'index.php';
            }, function(dismiss) {
              window.location.href = 'index.php';
            })

          } else if (temp['status'] == "failed") {
            swal({
              title: "ไม่สามารถเข้าสู่ระบบได้",
              text: "โปรดตรวจสอบชื่อผู้ใช้และรหัสผา่น",
              type: "error",
              showConfirmButton: false,
              timer: 1500
            })
          } else {
            console.log(temp['msg']);
          }
        }
      });
    }
    // end display
  </script>

</head>

<body class="bg-gradient-warning">

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-12 col-md-10 col-lg-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">

            <div class="p-5">
              <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-items-center mb-4">
                  <img class="img-fluid" src="assets/img/rmutl_logo.png" style="width: 4rem;">
                  <h1 class="h4 text-gray-900 m-4">RMUTL login!</h1>
                </div>
              </div>
              <div class="user">
                <fieldset>
                  <div class="form-group">
                    <input type="text" id="username" class="form-control form-control-user" placeholder="ชื่อผู้ใช้" autofocus>
                  </div>
                  <div class="form-group">
                    <input type="password" id="password" class="form-control form-control-user" placeholder="รหัสผ่าน">
                  </div>
                  <button onclick="check_login()" class="btn btn-primary btn-user btn-block py-3">
                    เข้าสู่ระบบ
                  </button>
                </fieldset>
              </div>
              <hr>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>


</body>

</html>