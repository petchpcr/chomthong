<?PHP
extract($_GET);
$sql = "SELECT * FROM tb_dorm_room WHERE dorm_room_id = {$id}";
$row = row_array($sql);

$sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$id}' AND roomer_status < 5";
$cc = result_array($sql);
$count_pp = count($cc);
?>
<div style="max-height: calc(100vh - 210px);overflow-y: auto;">
<?PHP
$sql = "SELECT * FROM tb_dorm_room_img WHERE dorm_room_id = '{$id}'";
$photo = result_array($sql);
?>
<?PHP foreach ($photo as $key => $p) { ?>
    <?PHP
        $style = 'style="width: 80px; height: 80px; float: left; padding: 0; margin: 5px;"';

        if ($key == 0) {
            $style = 'style="width: 50%; height: auto; margin:0 auto;"';
        }
        ?>
    <div class="thumbnail" <?= $style; ?>>
        <div class="caption">
            <span id="image<?= $key; ?>">
                <a href="uploads/<?= $p['dorm_room_img_name']; ?>" data-fancybox="photo">
                    <img src="uploads/<?= $p['dorm_room_img_name']; ?>" width="100%" />
                </a>
            </span>
        </div>
    </div>
<?PHP } ?>
</div>
<div class="clearfix"></div>
<hr>
<p>
    <b>ชื่อห้องพัก :</b>
    <?= $row['dorm_room_name']; ?>
</p>
<p>
    <b>รายละเอียดห้องพัก :</b>
    <?= $row['dorm_room_detail']; ?>
</p>
<p>
    <b>สถานะห้องพัก :</b>
    <?= dorm_room_status($row['dorm_room_status']); ?> ,
    [ <?= $count_pp; ?> / 4 คน ]
</p>

<hr>
<h5 class="text-center">รายชื่อผู้เข้าพัก</h5>
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