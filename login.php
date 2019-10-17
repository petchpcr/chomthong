<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบริหารจัดการ</title>
  <!-- <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" /> -->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/sb-admin-2.css" rel="stylesheet">
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
              <form class="user" method="post" action="process/check_login.php">
                <fieldset>
                  <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-user" placeholder="ชื่อผู้ใช้" autofocus>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="รหัสผ่าน">
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block py-3">
                    เข้าสู่ระบบ
                  </button>
                </fieldset>
              </form>
              <hr>
            </div>

          </div>
        </div>

      </div>

    </div>
  </div>


</body>

</html>