<?PHP
$id = "";
$name = "";
$detail = "";
$picture = "";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_building WHERE building_id = {$id}";
    $row = row_array($sql);

    $name = $row['building_name'];
    $detail = $row['building_detail'];
    $picture = $row['building_picture'];
}

?>

<form action="process/building_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">


    <?PHP if ($picture != "") { ?>
        <div class="col-md-12 text-center">
            <img style="width: auto; height: 150px;" src="uploads/<?= $picture; ?>" alt="">

            <hr>
        </div>
    <?PHP } ?>

    <div class="col-md-12">
        <div class="form-group">
            <label>ชื่ออาคาร :</label>
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
            <label>รูปภาพ :</label>
            <input type="file" name="picture">
        </div>
    </div>
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>