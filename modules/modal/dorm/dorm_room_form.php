<?PHP
$id = "";
$name = "";
$detail = "";
$dorm_id = $_GET['dorm_id'];

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "SELECT * FROM tb_dorm_room WHERE dorm_room_id = {$id}";
  $row = row_array($sql);

  $name = $row['dorm_room_name'];
  $detail = $row['dorm_room_detail'];
}

?>

<form action="process/dorm_room_process.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $id ?>">
  <input type="hidden" name="dorm_id" value="<?= $dorm_id ?>">


  <div class="col-md-12">
    <div class="form-group">
      <label>เลขห้องพัก :</label>
      <input type="text" class="form-control numberOnly" name="name" value="<?= $name; ?>" required>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label>รายละเอียด :</label>
      <textarea name="detail" class="form-control" rows="3" required><?= $detail; ?></textarea>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label>
        รูปภาพ
        <small style="color: red;">สามารถเลือกได้หลายรูป</small>
      </label>
      <input type="file" multiple name="img[]" accept="image/*">
    </div>

    <?PHP
    $sql = "SELECT * FROM tb_dorm_room_img WHERE dorm_room_id = '{$id}'";
    $list = result_array($sql);
    ?>

    <?PHP if (count($list) > 0) { ?>
      <div class="container-fluid" style="border: 1px solid #000; padding: 15px 20px; margin-bottom: 20px;max-height: calc(100vh - 210px);overflow-y: auto;">
        <label style="width: 100%;">
          รูปภาพที่อัพโหลดไปแล้ว :
        </label>
        <?PHP foreach ($list as $row) { ?>
          <div style="padding: 5px; float: left">
            <center>
              <a href="uploads/<?PHP echo $row['dorm_room_img_name']; ?>" data-fancybox="gallery">
                <img src="uploads/<?PHP echo $row['dorm_room_img_name']; ?>" height="50">
              </a>
              <br>
              <a href="process/delete_img_dorm_room.php?id=<?PHP echo $row['dorm_room_img_id']; ?>" onclick="return confirm_custom(this.href,'ยืนยันการลบ?')" class="btn btn-danger btn-xs">ลบ</a>
            </center>
          </div>
        <?PHP } ?>
      </div>

    <?PHP } ?>
  </div>

  <div class="col-md-12 text-right">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</form>