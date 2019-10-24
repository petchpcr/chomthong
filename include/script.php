<?PHP
include 'function/db_function.php';
include 'function/function.php';
check_login('id','login.php');
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>ระบบริหารจัดการ</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">

<script src="assets/plugins/jquery/jquery.js"></script>
<!-- <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet"/> -->
<link href="assets/css/sb-admin-2.css" rel="stylesheet">
<link href="assets/css/chomthong.css" rel="stylesheet">
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/style.css" rel="stylesheet"/>
<link href="assets/css/main-style.css" rel="stylesheet"/>
<link href="assets/css/app.css" rel="stylesheet"/>
<link href="assets/css/dropify.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Prompt:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

<!-- <script src="assets/plugins/jquery.js"></script> -->
<!-- <script src="assets/plugins/bootstrap/bootstrap.min.js"></script> -->

<link href="assets/plugins/dataTables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css"/>

<!-- <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script> -->

<link rel="stylesheet"  href="assets/js/fancybox/fancybox.css"/>
<script src="assets/js/fancybox/fancybox.js"></script>

<link rel="stylesheet"  href="assets/js/monthly/monthly.css"/>
<script src="assets/js/monthly/monthly.js"></script>

<link rel="stylesheet" href="assets/css/sweetalert2.min.css">
<script src="assets/js/sweetalert2.min.js"></script>


<style>
    .form-group , .modal-body{
        overflow: hidden;
    }
</style>

<script>
    $(document).ready(function () {
        $('#table-js').dataTable();


        $('input.numberOnly').keyup(function(e)
        {
            if (/\D/g.test(this.value))
            {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
        });
    });
</script>