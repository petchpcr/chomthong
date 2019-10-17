<div id="wrapper">
  <?PHP include "include/menu.php"; ?>

  <div id="content-wrapper" class="d-flex flex-column">

    <?PHP include "include/header.php"; ?>

    <div class="container-fluid mb-4">
      <div class="col text-center" style="display: block">
        <div class="btn btn-warning btn-circle btn-xxl shadow-lg m-4">
          <i class="fa fa-home"></i>
        </div>
      </div>
      <h1 class="text-center text-truncate h3 mb-4">อนุมัติการจองห้องพัก</h1>

      <div class="row d-flex justify-content-center">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="table-js">
            <thead>
              <tr>
                <th width="50" class="text-center">ลำดับ</th>
                <th class="text-center">หอพัก</th>
                <th width="70" class="text-center">ห้อง</th>
                <th class="text-center">ผู้จอง</th>
                <th class="text-center">วันที่จอง</th>
                <th width="80" class="text-center">เรียกดู</th>
                <th width="80" class="text-center">อนุมัติ</th>
                <th width="80" class="text-center">ไม่อนุมัติ</th>
              </tr>
            </thead>
            <?PHP
            $sql = "SELECT * FROM tb_roomer a 
                    inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id 
                    inner join tb_dorm d on b.dorm_id = d.dorm_id 
                    where a.roomer_status = 0 
                    order by b.dorm_id asc , b.dorm_room_name";
            $list = result_array($sql);
            ?>

            <?PHP if (count($list) > 0) { ?>
              <hr>

              <center>
                <a href="process/update_all_roomer.php?status=1" class="btn btn-success btn-lg" onclick="return confirm('ยืนยันการอนุมัติทั้งหมด?');">อนุมัติทั้งหมด</a>
                <a href="process/update_all_roomer.php?status=9" class="btn btn-danger btn-lg" onclick="return confirm('ยืนยันการไม่อนุมัติทั้งหมด?');">ไม่อนุมัติทั้งหมด</a>
              </center>

              <hr>
            <?PHP } ?>

            <?PHP foreach ($list as $key => $_list) { ?>
              <tr>
                <td class="text-center"><?= $key + 1; ?></td>
                <td class="text-center"><?= $_list['dorm_name']; ?></td>
                <?php $user = get_text_user_id($_list['renter_id']); ?>
                <td class="text-center"><?= $_list['dorm_room_name']; ?></td>
                <td class="text-center"><?= $user['name'] . " " . $user['lastname']; ?></td>
                <td class="text-center"><?= date_format(date_create($_list['roomer_date_out']), "d/m/Y") ?></td>
                <td class="text-center">
                  <a data-remote="false" data-toggle="modal" data-target="#hrefModal" class="btn btn-primary" style="width: 100%;" href="index.php?module=modal&action=dorm/dorm_room_detail&id=<?= $_list['dorm_room_id']; ?>">
                    <i class="fa fa-eye"></i>
                  </a>
                </td>
                <td class="text-center">
                  <a href="process/update_roomer.php?status=1&id=<?= $_list['roomer_id']; ?>&dorm_room_id=<?= $_list['dorm_room_id']; ?>" class="btn btn-success" style="width: 100%;" onclick="return confirm('ยืนยันการอนุมัติ?');">
                    <i class="fa fa-check"></i>
                  </a>
                </td>
                <td class="text-center">
                  <a href="process/update_roomer.php?status=9&id=<?= $_list['roomer_id']; ?>&dorm_room_id=<?= $_list['dorm_room_id']; ?>" class="btn btn-danger" style="width: 100%;" onclick="return confirm('ยืนยันการไม่อนุมัติ?');">
                    <i class="fa fa-times"></i>
                  </a>
                </td>
              </tr>
            <?PHP } ?>

          </table>
        </div>


      </div>
    </div>


  </div>

</div>