<?PHP
$id = "";
$code = "";
$category = "";
$name = "";
$type = "อุปกรณ์การเรียนการสอน";
$building_room_id = "";
$picture = "";


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_equipment WHERE equipment_id = {$id}";
    $row = row_array($sql);

    $code = $row['equipment_code'];
    $type = $row['equipment_type'];
    $category = $row['equipment_category'];
    $name = $row['equipment_name'];
    $building_room_id = $row['building_room_id'];
    $picture = $row['equipment_picture'];
}

?>

<form action="process/equipment_process.php" method="post" enctype="multipart/form-data" class="row">
    <input type="hidden" name="id" value="<?= $id ?>">

    <?PHP if ($picture != "") { ?>
        <div class="col-md-12 text-center">
            <img style="width: auto; height: 150px;" src="uploads/<?= $picture; ?>" alt="">

            <hr>
        </div>
    <?PHP } ?>


    <div class="col-md-12">
        <label for="" style="margin: 0 20px 20px 0;">หมวดหมู่ :</label>
            <label>
                <input type="radio" name="type"<?= $type == "อุปกรณ์การเรียนการสอน" ? "checked" : ""; ?> value="อุปกรณ์การเรียนการสอน">
                อุปกรณ์การเรียนการสอน
            </label>

            <label>
                <input type="radio" name="type"<?= $type == "สิ่งของและอุปกรณ์" ? "checked" : ""; ?> value="สิ่งของและอุปกรณ์">
                สิ่งของและอุปกรณ์
            </label>
    </div>


    <div class="col-md-12">
        <div class="form-group">
            <label>รหัสครุภัณฑ์ :</label>
            <input type="text" class="form-control" name="code" value="<?= $code; ?>" required>
        </div>
    </div>

    <!-- <div class="col-md-6">
        <div class="form-group">
            <label>ประเภทครุภัณฑ์ :</label>
            <input type="text" class="form-control" name="category" value="<?= $category; ?>" required>
        </div>
    </div> -->
    <div class="col-md-12">
        <div class="form-group">
            <label>ชื่อครุภัณฑ์ :</label>
            <input type="text" class="form-control" name="name" value="<?= $name; ?>" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>อาคาร / ห้อง :</label>
            <select name="building_room_id" class="form-control" required>
                <option disabled selected value="">เลือกอาคาร / ห้องที่จะจอง</option>
                <?PHP
                $sql = "SELECT * FROM tb_building_room b inner join tb_building d on b.building_id = d.building_id where b.delete_data = 0";
                $building_room = result_array($sql);
                ?>
                <?PHP foreach ($building_room as $_building_room) { ?>
                    <option <?= $building_room_id == $_building_room['building_room_id'] ? "selected" : "" ?>
                            value="<?= $_building_room['building_room_id']; ?>">
                        <?= $_building_room['building_name']; ?> /
                        <?= $_building_room['building_room_name']; ?>
                    </option>
                <?PHP } ?>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>รูปภาพ :</label>
            <input type="file" name="picture">
        </div>
    </div>


    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>