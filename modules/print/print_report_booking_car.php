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
    $Q_Type = "";
    $Q_Car = "";
    $head_type = "";
    $head_car = "";

    if ($_GET['Type'] != null) {
        $Type = $_GET['Type'];
        $Q_Type = " AND b.car_type_id = " . $Type;
        $sql = "SELECT car_type_name FROM tb_car_type WHERE car_type_id = '{$Type}'";
        $car_type = row_array($sql);
        $head_type = "รถ" . $car_type['car_type_name'];
    }
    if ($_GET['Car'] != null) {
        $Car = $_GET['Car'];
        $Q_Car = " AND a.car_id = " . $_GET['Car'];
        $sql = "SELECT car_licence FROM tb_car WHERE car_id = '{$Car}'";
        $car_ = row_array($sql);
        $head_car = " ป้ายทะเบียน " . $car_['car_licence'];
    }
    $sql = "SELECT * FROM tb_car_lend a 
        inner join tb_car b on a.car_id = b.car_id 
        inner join tb_driver d on a.driver_id = d.driver_id 
        where car_lend_status = 3 " . $Q_Type . $Q_Car . " 
        AND DATE(car_lend_date) between '{$start}' and '{$end}' 
        ORDER BY car_lend_starttime ASC";

    $list = result_array($sql);
    ?>

    <p class="text-center print" style="padding: 20px;">
        <button onclick="return window.print();" type="button" class="btn btn-primary"><i class="fa fa-print"></i>
            Print
        </button>
    </p>

    <div class="a4">

        <img src="../../assets/img/logo.jpg" style="width: auto; height: 80px; position: absolute; top: 8px; left: 45px" alt="">

        <h1>รายงานการจองรถ</h1>
        <h2>
            มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ศูนย์การจัดการศึกษาพิเศษ (จอมทอง)
        </h2>

        <p style="position: absolute; top: 12px; right: 20px; font-weight: bold;">
            พิมพ์วันที่ : <?= date("Y-m-d"); ?>
        </p>

        <hr>

        <h2>
            สถิติการจองรถประจำวันที่ <?= date_th($start); ?> ถึง <?= date_th($end); ?> <br>
            <?= $head_type.$head_car; ?>
        </h2>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="50" class="text-center">ลำดับ</th>
                    <th class="text-center">ป้ายทะเบียน</th>
                    <th class="text-center">ประเภท</th>
                    <th class="text-center">สถานที่</th>
                    <th class="text-center">เริ่มต้น</th>
                    <th class="text-center">สิ้นสุด</th>
                </tr>
            </thead>
            <tbody>

                <?PHP foreach ($list as $key => $_list) { ?>
                    <tr>
                        <td class="text-center"><?= $key + 1; ?></td>
                        <td class="text-center"><?= $_list['car_licence']; ?></td>
                        <td class="text-center"><?= get_car_type_name($_list['car_type_id']); ?> <?= $_list['car_brand']; ?> <?= $_list['car_model']; ?></td>
                        <td class="text-center"><?= $_list['car_lend_place']; ?></td>
                        <td class="text-center"><?= $_list['car_lend_starttime']; ?></td>
                        <td class="text-center"><?= $_list['car_lend_endtime']; ?></td>
                    </tr>
                <?PHP } ?>

                <?PHP if (count($list) == 0) { ?>
                    <tr>
                        <td colspan="7" style="color: red; text-align: center;">ไม่พบข้อมูล</td>
                    </tr>
                <?PHP } ?>
            </tbody>
        </table>


        <div class="footer">
            <hr style="width: 188mm;">
            มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ศูนย์การจัดการศึกษาพิเศษ (จอมทอง) <br>
            โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183
        </div>

    </div>

</body>

</html>