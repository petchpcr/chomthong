<?PHP
include '../../function/db_function.php';
include '../../function/function.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>รายงาน</title>
    <link href="../../assets/plugins/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="../../assets/fonts/thsarabunnew/thsarabunnew.css" rel="stylesheet">
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        .a4 {
            font-family: 'THSarabunNew', sans-serif !important;
            height: auto;
            width: 210mm;
            min-height: 250mm;
            margin: 20px auto 20px auto;
            border: 1px solid #f1f1e3;
            padding: 80px 40px 20px 40px;
            line-height: 20px;
            overflow: hidden;
            position: relative;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            line-height: 30px;
            margin: 0;
        }

        h2 {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            padding-bottom: 2px;
            line-height: 30px;
            margin: 0;
        }

        span {
            padding: 0 0 0 15px;
            border-bottom: 1px dashed #000;
            display: inline-block;
            text-indent: 0px;

        }

        .sign_zone {
            margin-top: 20px;
            margin-right: 20px;
            float: right;
            /* border: #000 solid 1px; */
            text-align: center;
        }

        .sen {
            width: 150px;
            height: 70px;
            margin: 5px auto;
        }

        .bor_titel {
            width: 49%;
            border: 2px solid #000;
            border-radius: 20px;
            padding: 20px 10px;
            margin-bottom: 30px;
        }

        table.tb_title {
            width: 100%;
            height: 80px;
        }

        .car-detail{
            padding: 20px;
        }

        .car-detail p {
            margin-bottom: 20px;
        }

        .footer {
            width: 100%;
            line-height: 30px;
            font-weight: bold;
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        @media print {
            .a4 {
                border: none;
                height: 205mm;
            }

            .footer {
                width: 100%;
                line-height: 30px;
                font-weight: bold;
                text-align: center;
                position: absolute;
                left: 0;
            }

            .print {
                display: none;
            }
        }

        svg {
            width: 150px;
            height: 70px;
        }
    </style>
</head>

<body>

<?PHP
extract($_GET);
$sql = "SELECT * FROM tb_car_lend a inner join tb_car b on a.car_id = b.car_id inner join tb_driver d on a.driver_id = d.driver_id where car_lend_id = '{$car_lend_id}'";
$row = row_array($sql);

$user = get_text_user_id($row['reservations_id']);
?>

<p class="text-center print" style="padding: 20px;">
    <button onclick="return window.print();" type="button" class="btn btn-primary"><i class="fa fa-print"></i>
        Print
    </button>
</p>

<div class="a4">



    <h1>
        <img src="../../assets/img/logo.jpg" style="width: auto; height: 40px;"
             alt="">
        เอกสารการเดินรถ
    </h1>
    <h2>
        มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ศูนย์การจัดการศึกษาพิเศษ (จอมทอง)
    </h2>


    <p style="position: absolute; top: 12px; right: 20px; font-weight: bold;">
        พิมพ์วันที่ : <?=date("Y-m-d");?>
    </p>



    <div class="car-detail">
        <p style="text-indent: 50px;">
            ใบการจองรถฉบับนี้เป็นเอกสารยืนยันว่า
            <span style="width: 185px;"><?= $user['name']; ?> <?= $user['lastname']; ?></span>
            ตำแหน่ง <span style="width: 150px;"><?= status($user['status']); ?></span>
        </p>
        <p>
            ได้ทำการจอง
            <span style="width: 300px;">
                <?= get_car_type_name($row['car_type_id']); ?> <?= $row['car_brand']; ?> <?= $row['car_model']; ?>
            </span>
            ป้ายทะเบียน
            <span style="width: 210px;"><?= $row['car_licence']; ?></span>
        </p>

        <p>
            ไปยังสถานที่
            <span style="width: 594px;"><?= $row['car_lend_place']; ?></span>
        </p>

        <p>
            โดยมีจุดประสงค์เพื่อ
            <span style="width: 542px;"><?= $row['car_lend_objective']; ?></span>
        </p>

        <p>
            ผู้ขับ
            <span style="width: 375px;">
                <?= $row['driver_title']; ?><?= $row['driver_name']; ?> <?= $row['driver_lastname']; ?>
            </span>
            โดยมีผู้โดยสารทั้งหมด
            <span style="width: 102px;"><?= $row['car_lend_people']; ?></span>
            คน
        </p>

        <p>
            ในวันที่
            <?= datetime_car_lend($row['car_lend_starttime']); ?>
        </p>

        <p>
            ถึงวันที่
            <?= datetime_car_lend($row['car_lend_endtime']); ?>
        </p>

        <?PHP
        $user_approve = $row['user_approve'];
        $Sql = "SELECT personnel_name AS sign_name,
                        personnel_lastname AS sign_Lname,
                        personnel_title AS sign_title,
                        signature 
                FROM tb_personnel 
                WHERE personnel_idcard = '$user_approve'";
        $sign = row_array($Sql);
        ?>

        <div class="sign_zone">
            <div class="sen">
                <?= $sign['signature']; ?>
            </div>
            <center>
                <div style="margin-bottom:5px;">(<?= $sign['sign_title'] . $sign['sign_name'] . " " . $sign['sign_Lname']; ?>)</div>
                <div>เจ้าหน้าที่ผู้อนุมัติการใช้งานรถ</div>
            </center>
        </div>
    </div>


    <div class="footer">
        <hr style="width: 188mm;">
        มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ศูนย์การจัดการศึกษาพิเศษ (จอมทอง) <br>
        โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183
    </div>


</div>

</body>
</html>
