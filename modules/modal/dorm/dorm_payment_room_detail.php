<?PHP
extract($_GET);
$sql = "SELECT * FROM tb_dorm_payment a inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id inner join tb_dorm d on b.dorm_id = d.dorm_id WHERE dorm_payment_id = '{$dorm_payment_id}'";
$row = row_array($sql);

$sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$row['dorm_room_id']}' AND roomer_status < 5";
$cc = result_array($sql);
$count_pp = count($cc);
?>

<h5 class="text-center">ห้อง <?= $row['dorm_room_name']; ?> มีผู้เข้าพัก</h5>
<table class="table">
    <tr>
        <th class="text-center" width="100">รหัส</th>
        <th class="text-center">ชื่อ-นามสกุล</th>
        <th class="text-center" width="100">สถานะ</th>
    </tr>
    <?PHP foreach ($cc as $_cc) { ?>
        <?PHP
        $user = get_text_user_id($_cc['renter_id']);
        ?>
        <tr>
            <td class="text-center"><?= $user['code']; ?></td>
            <td><?= $user['name']; ?> <?= $user['lastname']; ?></td>
            <td class="text-center"><?= roomer_status($_cc['roomer_status']) ?></td>
        </tr>
    <?PHP } ?>

    <?PHP if ($count_pp == 0) { ?>
        <tr style="background: #ffc6b5;">
            <th class="text-center" colspan="3">ไม่มีผู้เข้าพัก</th>
        </tr>
    <?PHP } ?>
</table>

<hr>

<?PHP $total = $row['dorm_payment_price'] + $row['dorm_payment_electric'] + $row['dorm_payment_water'] + $row['dorm_payment_other']; ?>


<h5 class="text-center">ประจำเดือน <?= month_name($row['dorm_payment_month']); ?> <?= $row['dorm_payment_year']; ?></h5>

<p>
    <b>ค่าห้อง : </b> <?= number_format($row['dorm_payment_price']); ?> บาท <br>
</p>
<p>
    <b>ค่าไฟ : </b> <?= number_format($row['dorm_payment_electric']); ?> บาท <br>
</p>
<p>
    <b>ค่าน้ำ : </b> <?= number_format($row['dorm_payment_water']); ?> บาท<br>
</p>
<p>
    <b>ค่าอื่นๆ : </b> <?= number_format($row['dorm_payment_other']); ?> บาท
</p>

<p>
    <b>ยอดรวม : </b> <?= number_format($total); ?> บาท
</p>

<p>
    <b>ประจำเดือน : </b> <?= month_name($row['dorm_payment_month']); ?> <?= $row['dorm_payment_year']; ?>
</p>

<p>
    <b>วันที่ออกใบแจ้ง : </b> <?= $row['dorm_payment_date_invoice']; ?>
</p>
<p>
    <b>สถานะ : </b> <?= dorm_payment_status($row['dorm_payment_status']); ?>
</p>

<p>
    <b>หมายเหตุ : </b> <?= $row['dorm_payment_msg']; ?>
</p>

<hr>

<?PHP if ($row['dorm_payment_status'] == 0) { ?>
    <center>
        <a href="modules/print/print_alert_dorm_payment.php?dorm_payment_id=<?=$row['dorm_payment_id'];?>"
           target="_blank"
           class="btn btn-primary">
            <i class="fa fa-file-text"></i> ใบแจ้งหนี้
        </a>
    </center>
<?PHP }elseif ($row['dorm_payment_status'] == 1) { ?>
    <center>
        <a href="modules/print/print_dorm_payment.php?dorm_payment_id=<?=$row['dorm_payment_id'];?>"
           target="_blank"
           class="btn btn-primary">
            <i class="fa fa-file-text"></i> ใบเสร็จรับเงิน
        </a>
    </center>
<?PHP } ?>

