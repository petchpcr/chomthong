<?PHP
$id = "";
$name = "";
$detail = "";
$price = "";
$picture = "";
$position = "";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_dorm WHERE dorm_id = {$id}";
    $row = row_array($sql);

    $name = $row['dorm_name'];
    $detail = $row['dorm_detail'];
    $price = $row['dorm_price'];
    $picture = $row['dorm_picture'];
    $position = $row['dorm_position'];
    $gender = $row['dorm_gender'];
}

?>

<form action="process/dorm_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">


    <?PHP if ($picture != "") { ?>
        <div class="col-md-12 text-center">
            <img style="width: auto; height: 150px;" src="uploads/<?= $picture; ?>" alt="">

            <hr>
        </div>
    <?PHP } ?>

    <div class="col-md-12">
        <div class="form-group">
            <label>สิทธิการเข้าพัก :</label>
            <select name="position" class="form-control" required>
                <option disabled selected value="">เลือกสิทธิการเข้าพัก</option>
                <option <?= $position == "1" ? "selected" : ""; ?> value="1"><?= dorm_position(1); ?></option>
                <option <?= $position == "0" ? "selected" : ""; ?> value="0"><?= dorm_position(0); ?></option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>ประเภท :</label>
            <select name="gender" class="form-control" required>
                <option <?= $gender == "0" ? "selected" : ""; ?> value="0"><?= dorm_gender(0); ?></option>
                <option <?= $gender == "1" ? "selected" : ""; ?> value="1"><?= dorm_gender(1); ?></option>
                <option <?= $gender == "2" ? "selected" : ""; ?> value="2"><?= dorm_gender(2); ?></option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>ชื่อหอพัก :</label>
            <input type="text" class="form-control" name="name" value="<?= $name; ?>" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>ราคา :</label>
            <input type="text" class="form-control numberOnly" name="price" value="<?= $price; ?>" required>
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
            <label>รูปภาพ :</label>
            <input type="file" name="picture">
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>