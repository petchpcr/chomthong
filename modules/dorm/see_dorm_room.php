<?PHP
if ($_SESSION['status'] == 0 && $_SESSION['title'] != 'นางสาว') {
  echo "<script>window.location.href='index.php';</script>";
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
            <div class="row">
              <div class="col-md-4">
                <img src="uploads/<?= $title['dorm_picture']; ?>" class="img-responsive" alt="">
              </div>

              <div class="col-md-8">
                <h2><?= $title['dorm_name']; ?></h2>
                <p>
                  <b>ราคา : </b> <?= number_format($title['dorm_price']); ?>
                </p>
                <p>
                  <b>รายละเอียด : </b> <?= $title['dorm_detail']; ?>
                </p>
              </div>
            </div>
          </div>
          <?PHP
          $sql = "SELECT DISTINCT SUBSTRING(a.dorm_room_name,1,1) as dorm_room_name FROM tb_dorm_room a inner join tb_dorm b on a.dorm_id = b.dorm_id where a.delete_data = 0 and a.dorm_id = '{$dorm_id}' ORDER BY a.dorm_room_name ASC";
          $list_floor = result_array($sql);
          ?>
          <select id="dorm_room_floor" class="form-control" data-dorm="<?= $dorm_id; ?>">
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
                ORDER BY dorm_room_name ASC";
        $list = result_array($sql);
        ?>

        <?PHP foreach ($list as $key => $_list) { ?>

          <div class="col" style="max-width:250px;min-width:250px;">
            <div class="list-driver">
              <div class="col">
                <p style="font-size: 25px; font-weight: bold; padding: 30px 0;">
                  <?= $_list['dorm_room_name']; ?>
                </p>
              </div>
              <a data-remote="false" data-toggle="modal" data-target="#hrefModal" href="index.php?module=modal&action=dorm/dorm_room_detail&dorm_id=<?= $dorm_id; ?>&id=<?= $_list['dorm_room_id']; ?>" class="btn btn-sm btn-info btn-rounded">
                รายละเอียด
              </a>
            </div>
          </div>

        <?PHP } ?>
        </tbody>
      </div>


    </div>
  </div>

</div>