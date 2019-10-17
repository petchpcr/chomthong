<?PHP
extract($_GET);
$sql = "select * from tb_equipment a inner join tb_building_room b on a.building_room_id = b.building_room_id inner join tb_building d on b.building_id = d.building_id where  a.equipment_id = '{$equipment_id}'";
$title = row_array($sql);
?>

<div class="row">

    <div class="col-lg-12">
        <h3 class="text-center">รายละเอียดการยืม</h3>
        <p class="text-center">
            <b>รหัส :</b> <?=$title['equipment_code'];?> &nbsp;
            <b>ชื่อ :</b> <?=$title['equipment_name'];?> &nbsp;
            <b>ตึก :</b> <?=$title['building_name'];?> / <?= $title['building_room_name']; ?>
        </p>
    </div>

    <div class="col-lg-12">


        <?PHP
        $sql = "SELECT DATE_FORMAT(equipment_lend_date_start,'%d-%m-%Y %H:%i') AS start,DATE_FORMAT(equipment_lend_date_return,'%d-%m-%Y %H:%i') AS end,lender_id FROM tb_equipment_lend where equipment_lend_status < 3 ";
        $list = result_array($sql);
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">วันที่ยืม</th>
                    <th class="text-center">ผู้ยืม</th>
                </tr>
                </thead>
                <tbody>
                <?PHP foreach ($list as $key => $_list) { ?>
                    <tr>

                        <td class="text-center">
                            <?= $_list['start']; ?> -  <?= $_list['end']; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            $user = get_text_user_id($_list['lender_id']);
                            ?>
                            [ <?=status($user['status']);?> ] <?=$user['name'];?> <?=$user['lastname'];?>
                        </td>
                    </tr>
                <?PHP } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>