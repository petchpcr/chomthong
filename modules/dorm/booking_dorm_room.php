<?PHP
$sql = "SELECT * FROM tb_setting where setting_id = 1";
$row = row_array($sql);

if ($row['setting_value'] != 1) {
  echo "<meta charset='utf-8'/><script>alert('ปิดระบบการจองห้องพักแล้ว!!');location.href='index.php?module=dorm&action=booking';</script>";
}
?>


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
      <?PHP
      $dorm_id = $_GET['dorm_id'];
      $floor = $_GET['floor'];
      $sql = "SELECT * FROM tb_dorm where dorm_id = '{$dorm_id}'";
      $title = row_array($sql);
      ?>
      <h1 class="text-center text-truncate h3 mb-4">ห้องพักใน : <?= $title['dorm_name']; ?></h1>

      <div class="row d-flex justify-content-center">

        <div class="col-md-8 col-md-offset-2 mb-3">
          <div class="list-single">
            <div class="col-md-3">
              <a href="uploads/<?= $title['dorm_picture']; ?>" data-fancybox="zoom">
                <img src="uploads/<?= $title['dorm_picture']; ?>" class="img-responsive" alt="">
              </a>
            </div>

            <div class="col-md-9">
              <h2><?= $title['dorm_name']; ?></h2>
              <p>
                <b>ราคา : </b> <?= number_format($title['dorm_price']); ?>
              </p>
              <p>
                <b>รายละเอียด : </b> <?= $title['dorm_detail']; ?>
              </p>
            </div>
          </div>
          <?PHP
          $sql = "SELECT DISTINCT SUBSTRING(a.dorm_room_name,1,1) as dorm_room_name 
                  FROM tb_dorm_room a 
                  inner join tb_dorm b on a.dorm_id = b.dorm_id
                  where a.delete_data = 0 
                  and a.dorm_id = '{$dorm_id}' 
                  ORDER BY a.dorm_room_name ASC";
          $list_floor = result_array($sql);
          ?>
          <select id="booking_dorm_room_floor" class="form-control" data-dorm="<?= $dorm_id; ?>">
            <option value="">ทุกชั้น</option>
            <?PHP foreach ($list_floor as $key => $_floor) { ?>
              <option <?= $floor == $_floor['dorm_room_name'] ? "selected" : "" ?> value="<?= $_floor['dorm_room_name'] ?>">
                ชั้น <?= $_floor['dorm_room_name']; ?>
              </option>
            <?PHP } ?>
          </select>
        </div>
      </div>

      <div class="row d-flex justify-content-center">


        <?PHP
        $sql = "SELECT * FROM tb_dorm_room a 
                inner join tb_dorm b on a.dorm_id = b.dorm_id 
                where a.delete_data = 0 
                and a.dorm_id = '{$dorm_id}' 
                AND dorm_room_name LIKE '{$floor}%'
                ORDER BY a.dorm_room_name ASC";
        $list = result_array($sql);
        ?>


        <?PHP foreach ($list as $key => $_list) { ?>

          <div class="col" style="max-width:250px; min-width:250px;">

            <?PHP
              $red = "#ffcac8";
              $green = "#c1f5d4";
              $yellow = "#F5F1C2";

              $sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$_list['dorm_room_id']}' AND roomer_status < 5";
              $cc = result_array($sql);
              $count_pp = count($cc);
              ?>

            <?PHP
              if ($_list['dorm_room_status'] == 0) {
                $bg = $red;
              } elseif ($_list['dorm_room_status'] == 1) {
                $bg = $green;
              } elseif ($_list['dorm_room_status'] == 2) {
                $bg = $yellow;
              }
              ?>


            <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=dorm/booking_dorm_room_detail&id=<?= $_list['dorm_room_id']; ?>">
              <div class="list-driver hover_all" style="background: <?= $bg; ?>;">
                <div class="col-md-12">
                  <p style="font-size: 25px; font-weight: bold; padding: 15px 0;">
                    <?= $_list['dorm_room_name']; ?>
                  </p>
                </div>
                <div class="col-md-12">
                  <p class="text-center">
                    <?= dorm_room_status($_list['dorm_room_status']); ?>
                  </p>

                  <p>
                    [ <?= $count_pp; ?> / 4 คน ]
                  </p>

                </div>
              </div>
            </a>


          </div>

        <?PHP } ?>
        </tbody>
      </div>
    </div>


  </div>

</div>