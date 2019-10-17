<?PHP
include '../../function/db_function.php';
include '../../function/function.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
            min-height: 295mm;
            margin: 20px auto 20px auto;
            border: 1px solid #f1f1e3;
            padding: 20px 40px 90px 40px;
            line-height: 20px;
            overflow: hidden;
            position: relative;
        }

        h1 {
            text-align: center;
            font-size: 18px;
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
            padding: 0 50px 0 15px;
            border-bottom: 1px dashed #000;
        }

        .sen {
            width: 300px;
            height: 75px;
            font-size: 12px;
            text-align: center;
            line-height: 18px;
            padding-top: 20px;
            clear: both;
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
                height: auto;

            }

            .print {
                display: none;
            }

            .footer {
                width: 100%;
                line-height: 30px;
                font-weight: bold;
                text-align: center;
                position: absolute;
                left: 0;
            }

            @page {
                padding-bottom: 90px;
            }

        }
    </style>
</head>

<body>

    <?PHP
    extract($_GET);
    $yy = date("Y");
    $mm = date("m");
    $floor = "";
    $dorm_id = "";
    $room = "";
    $head_name = "ทุกหอพัก";

    if ($_GET['dorm_id'] != null) {
        $dorm_id = $_GET['dorm_id'];
        $sql = "SELECT dorm_name FROM tb_dorm WHERE dorm_id = '{$dorm_id}'";
        $d_name = row_array($sql);
        $head_name = $d_name['dorm_name'];
    }
    if ($_GET['floor'] != null) {
        $floor = $_GET['floor'];
        $head_floor = " ชั้น ".$floor;
    }
    if ($_GET['room'] != null) {
        $room = $_GET['room'];
        $head_room = " ห้อง ".$room;
    }
    if ($_GET['yy'] != null) {
        $yy = $_GET['yy'];
    }
    if ($_GET['mm'] != null) {
        $mm = $_GET['mm'];
    }

    $sum_price = 0;
    

    $sql = "SELECT * FROM tb_dorm_payment a 
            inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id 
            inner join tb_dorm d on b.dorm_id = d.dorm_id 
            where dorm_payment_status = 1
            and dorm_payment_month = '{$mm}' 
            and dorm_payment_year = '{$yy}' 
            and b.dorm_id LIKE '%{$dorm_id}%' 
            and b.dorm_room_name LIKE '{$floor}%' 
            and b.dorm_room_name LIKE '%{$room}%' 
            order by b.dorm_id asc , b.dorm_room_name asc";
    $list = result_array($sql);
    ?>

    <p class="text-center print" style="padding: 20px;">
        <button onclick="return window.print();" type="button" class="btn btn-primary"><i class="fa fa-print"></i>
            Print
        </button>
    </p>

    <div class="a4">

        <img src="../../assets/img/logo.jpg" style="width: auto; height: 80px; position: absolute; top: 8px; left: 45px" alt="">

        <h1>รายงานการชำระเงินค่าหอพัก</h1>
        <h2>
            มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ศูนย์การจัดการศึกษาพิเศษ (จอมทอง)
        </h2>

        <p style="position: absolute; top: 12px; right: 20px; font-weight: bold;">
            พิมพ์วันที่ : <?= date("Y-m-d"); ?>
        </p>

        <hr>

        <h2>
            สถิติการชำระค่าหอพักประจำเดือน <?= month_name($mm); ?> <?= $yy + 543; ?> <br>
            <?= $head_name.$head_floor.$head_room; ?>
        </h2>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">ห้องพัก</th>
                    <th class="text-center">ค่าใช้จ่าย</th>
                    <th class="text-center">วันที่ออกใบแจ้งหนี้</th>
                    <th class="text-center">วันที่ชำระเงิน</th>
                </tr>
            </thead>
            <tbody>

                <?PHP foreach ($list as $key => $_list) { ?>
                    <tr>
                        <td class="text-center"><?= $_list['dorm_room_name']; ?></td>
                        <td class="text-center">
                            <?PHP $total = $_list['dorm_payment_price'] + $_list['dorm_payment_electric'] + $_list['dorm_payment_water'] + $_list['dorm_payment_other']; ?>
                            <?= number_format($total); ?> บาท
                        </td>
                        <td class="text-center"><?= $_list['dorm_payment_date_invoice']; ?></td>
                        <td class="text-center"><?= $_list['dorm_payment_date_pay']; ?></td>
                    </tr>
                <?PHP $sum_price = $sum_price + $total;
                } ?>
                <?PHP if (count($list) != 0) { ?>
                    <tr>
                        <td colspan="7" class="text-center"><b>รวมทั้งหมด <?= number_format($sum_price); ?> บาท</b></td>
                    </tr>
                <?PHP } ?>
                <?PHP if (count($list) == 0) { ?>
                    <tr>
                        <td colspan="7" style="color: red; text-align: center;">ไม่พบข้อมูล</td>
                    </tr>
                <?PHP } ?>
            </tbody>
        </table>

        <hr>

        <div class="footer">
            <hr style="width: 188mm;">
            มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ศูนย์การจัดการศึกษาพิเศษ (จอมทอง) <br>
            โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183
        </div>

    </div>

</body>

</html>