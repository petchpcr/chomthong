<?PHP
$id = "";
$licence = "";
$type = "";
$brand = "";
$model = "";
$color = "";
$sit = "";
$picture = "";


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_car WHERE car_id = {$id}";
    $row = row_array($sql);

    $licence = $row['car_licence'];
    $type = $row['car_type_id'];
    $brand = $row['car_brand'];
    $model = $row['car_model'];
    $color = $row['car_color'];
    $sit = $row['car_sit'];
    $picture = $row['car_picture'];

}

?>

<form action="process/car_process.php" method="post" enctype="multipart/form-data" class="row">
    <input type="hidden" name="id" value="<?= $id ?>">


    <?PHP if ($picture != "") { ?>
        <div class="col-md-12 text-center">
            <img style="width: auto; height: 150px;" src="uploads/<?= $picture; ?>" alt="">

            <hr>
        </div>
    <?PHP } ?>

    <div class="col-md-6">
        <div class="form-group">
            <label>ป้ายทะเบียน :</label>
            <input type="text" class="form-control" name="licence" value="<?= $licence; ?>" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>ประเภท :</label>
            <select name="type" class="form-control" required>
                <option disabled selected value="">เลือกประเภท</option>
                <?PHP
                $sql = "SELECT * FROM tb_car_type";
                $car = result_array($sql);
                ?>
                <?PHP foreach ($car as $_car) { ?>
                    <option <?=$type == $_car['car_type_id'] ? "selected":"" ?>
                            value="<?= $_car['car_type_id']; ?>">
                        <?= $_car['car_type_name']; ?>
                    </option>
                <?PHP } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>ยี่ห้อ :</label>
            <input type="text" class="form-control" name="brand" value="<?= $brand; ?>" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>รุ่น :</label>
            <input type="text" class="form-control" name="model" value="<?= $model; ?>" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>สี :</label>
            <input type="text" class="form-control" name="color" maxlength="15" value="<?= $color; ?>" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>จำนวนที่นั่ง :</label>
            <input type="text" class="form-control numberOnly" name="sit" maxlength="2" value="<?= $sit; ?>" required>
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