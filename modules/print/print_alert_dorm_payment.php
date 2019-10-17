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
            padding: 20px 40px;
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
            padding: 0 0 0 15px;
            border-bottom: 1px dashed #000;
            display: inline-block;
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

        @media print {
            .a4 {
                border: none;
                height: 205mm;
            }

            .print {
                display: none;
            }
        }

    </style>
</head>

<body>

<?PHP
extract($_GET);
$sql = "SELECT * FROM tb_dorm_payment a inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id inner join tb_dorm d on b.dorm_id = d.dorm_id WHERE dorm_payment_id = '{$dorm_payment_id}'";
$row = row_array($sql);
?>

<p class="text-center print" style="padding: 20px;">
    <button onclick="return window.print();" type="button" class="btn btn-primary"><i class="fa fa-print"></i>
        Print
    </button>
</p>

<div class="a4">

    <img src="../../assets/img/logo.jpg" style="width: auto; height: 80px; position: absolute; top: 8px; left: 45px"
         alt="">

    <h1>ใบแจ้งหนี้ค่าหอพัก</h1>
    <h2>
        มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ศูนย์การจัดการศึกษาพิเศษ (จอมทอง)
    </h2>

    <p style="position: absolute; top: 12px; right: 20px; font-weight: bold;">
        พิมพ์วันที่ : <?= date("Y-m-d"); ?>
    </p>

    <hr>

    <?PHP
    $sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$row['dorm_room_id']}' AND roomer_status < 5";
    $cc = result_array($sql);
    ?>

    <p>
        <b>ชื่อผู้เช่า :</b>
        <span style="width: 650px;">
        <?PHP foreach ($cc as $key => $_cc) { ?>
            <?PHP
            $user = get_text_user_id($_cc['renter_id']);

            if ($key != 0) {
                echo " , ";
            }

            ?>

            <?= $user['name']; ?> <?= $user['lastname']; ?>
        <?PHP } ?>
            </span>
    </p>
    <p>
        <b >หอพัก :</b>
        <span style="width: 318px;"><?= $row['dorm_name']; ?></span>
        <b>ห้อง :</b>
        <span style="width: 80px;"><?= $row['dorm_room_name']; ?></span>

        <b>ประจำเดือน :</b>
        <span style="width: 130px;">
            <?=month_name($row['dorm_payment_month']);?>
            <?=$row['dorm_payment_year'] + 543;?>
        </span>
    </p>


    <table class="table table-bordered">
        <tr>
            <th class="text-center" width="50">ลำดับ</th>
            <th class="text-center">รายการ</th>
            <th class="text-center" width="150">จำนวนเงิน</th>
        </tr>
        <tr>
            <td class="text-center">1</td>
            <td>ค่าห้องพัก</td>
            <td class="text-center"><?=number_format($row['dorm_payment_price'])?> บาท</td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td>ค่าไฟ</td>
            <td class="text-center"><?=number_format($row['dorm_payment_electric'])?> บาท</td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td>ค่าน้ำ</td>
            <td class="text-center"><?=number_format($row['dorm_payment_water'])?> บาท</td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td>อื่นๆ</td>
            <td class="text-center"><?=number_format($row['dorm_payment_other'])?> บาท</td>
        </tr>
        <tr>
            <?PHP $total = $row['dorm_payment_price'] + $row['dorm_payment_electric'] + $row['dorm_payment_water'] + $row['dorm_payment_other']; ?>
            <th colspan="2" class="text-right">รวมทั้งหมด</th>
            <td class="text-center"><?=number_format($total)?> บาท</td>
        </tr>
    </table>

    <p>
        <b>หมายเหตุ</b>
        <span style="width: 648px;">
            <?=$row['dorm_payment_msg']?>
        </span>
    </p>


</div>

</body>
</html>
