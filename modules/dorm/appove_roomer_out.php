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
      <h1 class="text-center text-truncate h3 mb-4">อนุมัติการแจ้งออกหอพัก</h1>

      <div class="row d-flex justify-content-center">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="table-js">
            <thead>
              <tr>
                <th width="50" class="text-center">ลำดับ</th>
                <th class="text-center">หอพัก</th>
                <th width="70" class="text-center">ห้อง</th>
                <th class="text-center">ผู้แจ้งออก</th>
                <th class="text-center">วันที่ออก</th>
                <th width="80" class="text-center">เรียกดู</th>
                <th width="80" class="text-center">อนุมัติ</th>
                <th width="80" class="text-center">ไม่อนุมัติ</th>
              </tr>
            </thead>
            <tbody>

              <?PHP
              $sql = "SELECT * FROM tb_roomer a 
                      inner join tb_dorm_room b on a.dorm_room_id = b.dorm_room_id 
                      inner join tb_dorm d on b.dorm_id = d.dorm_id 
                      where a.roomer_status = 2 
                      order by b.dorm_id asc , b.dorm_room_name";
              $list = result_array($sql);
              ?>

              <?PHP foreach ($list as $key => $_list) {
                $user = get_text_user_id($_list['renter_id']);
                $App_Title = "ยืนยันการอนุมัติ";
                $App_Text = $_list['dorm_name'] . " ห้อง " . $_list['dorm_room_name'] . " : " . $user['name'] . " " . $user['lastname'] . " อนุมัติ ?";
                $App_Color = "#1cc88a";
                $App_Link = "process/update_roomer.php?status=3&id=" . $_list['roomer_id'] . "&dorm_room_id=" . $_list['dorm_room_id'];

                $Un_Title = "ยืนยันการไม่อนุมัติ";
                $Un_Text = $_list['dorm_name'] . " ห้อง " . $_list['dorm_room_name'] . " : " . $user['name'] . " " . $user['lastname'] . " ไม่อนุมัติ ?";
                $Un_Color = "#d33";
                $Un_Link = "process/update_roomer.php?status=1&id=" . $_list['roomer_id'] . "&dorm_room_id=" . $_list['dorm_room_id'];
                ?>
                <tr>
                  <td class="text-center"><?= $key + 1; ?></td>
                  <td class="text-center"><?= $_list['dorm_name']; ?></td>
                  <td class="text-center"><?= $_list['dorm_room_name']; ?></td>
                  <td class="text-center"><?= $user['name'] . " " . $user['lastname']; ?></td>
                  <td class="text-center"><?= date_format(date_create($_list['roomer_date_out']), "d/m/Y") ?></td>
                  <td class="text-center">
                    <a data-remote="false" data-toggle="modal" data-target="#hrefModal" class="btn btn-primary" style="width: 100%;" href="index.php?module=modal&action=dorm/dorm_room_detail&id=<?= $_list['dorm_room_id']; ?>">
                      <i class="fa fa-eye"></i>
                    </a>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-success" style="width: 100%;" onclick="AlertConLink('<?= $App_Title; ?>', '<?= $App_Text; ?>', '<?= $App_Color; ?>', '<?= $App_Link; ?>')">
                      <i class="fa fa-check"></i>
                    </button>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-danger" style="width: 100%;" onclick="AlertConLink('<?= $Un_Title; ?>', '<?= $Un_Text; ?>', '<?= $Un_Color; ?>', '<?= $Un_Link; ?>')">
                      <i class="fa fa-times"></i>
                    </button>
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