<div id="wrapper">
    <?PHP include "include/header.php"; ?>
    <?PHP include "include/menu.php"; ?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <div class="menu-button-mini">
                    <i class="fa fa-car"></i>
                    <p>จัดการจองรถ</p>
                </div>
            </div>

            <div class="col-lg-12">

                <?PHP
                $sql = "SELECT * FROM tb_car_lend a inner join tb_car b on a.car_id = b.car_id inner join tb_driver d on a.driver_id = d.driver_id order by car_lend_id desc ";
                $list = result_array($sql);
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="table-js">
                        <thead>
                        <tr>
                            <th width="60" class="text-center">รูปภาพ</th>
                            <th class="text-center">รายการ</th>
                            <th class="text-center">ป้ายทะเบียน</th>
                            <th class="text-center">สถานที่</th>
                            <th class="text-center">วัตถุประสงค์</th>
                            <th class="text-center">วันเวลาเริ่มต้น-สิ้นสุด</th>
                            <th class="text-center">ผู้จอง</th>
                            <th class="text-center">สถานะ</th>
                            <th width="80" class="text-center">รายละเอียด</th>
                            <th width="55" class="text-center">ยกเลิก</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?PHP foreach ($list as $key => $_list) { ?>
                            <tr>
                                <td class="text-center">
                                    <img src="uploads/<?= $_list['car_picture']; ?>" style="width: auto; height: 50px;" alt="">
                                </td>
                                <td class="text-center"><?= get_car_type_name($_list['car_type_id']); ?> <?= $_list['car_brand']; ?> <?= $_list['car_model']; ?></td>
                                <td class="text-center"><?= $_list['car_licence']; ?></td>
                                <td class="text-center"><?= $_list['car_lend_place']; ?></td>
                                <td class="text-center"><?= $_list['car_lend_objective']; ?></td>
                                <td class="text-center"><?= $_list['car_lend_starttime']; ?> - <?= $_list['car_lend_endtime']; ?></td>
                                <td class="text-center">
                                    <?php
                                    $user = get_text_user_id($_list['reservations_id']);
                                    ?>
                                    [ <?=status($user['status']);?> ] <?=$user['name'];?> <?=$user['lastname'];?>
                                </td>
                                <td class="text-center"><?= car_lend_status($_list['car_lend_status']); ?></td>
                                <td class="text-center">
                                    <a href="modules/print/print_car_lend.php?car_lend_id=<?=$_list['car_lend_id']?>" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?PHP if($_list['car_lend_status'] == 0){ ?>
                                    <a href="process/update_car_lend.php?status=9&id=<?= $_list['car_lend_id']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('ยืนยันการยกเลิก?');">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <?PHP } ?>
                                </td>
                            </tr>
                        <?PHP } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

</div>



