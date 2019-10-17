<?PHP
$id = "";
$name = "";
$detail = "";
$type = "";
$building_id = $_GET['building_id'];

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_building_room WHERE building_room_id = {$id}";
    $row = row_array($sql);

    $name = $row['building_room_name'];
    $detail = $row['building_room_detail'];
    $type = $row['building_room_type'];
}

?>

<form action="process/building_room_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="hidden" name="building_id" value="<?= $building_id ?>">


    <div class="col-md-12">
        <div class="form-group">
            <label>ชื่อห้อง :</label>
            <input type="text" class="form-control" name="name" value="<?= $name; ?>" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>รายละเอียด :</label>
            <textarea name="detail" class="form-control" required><?= $detail; ?></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>ประเภท :</label>
            <input type="text" class="form-control" name="type" value="<?= $type; ?>" required>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>