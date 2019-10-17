<?PHP
$id = "";
$major_id = "";
$major_name = "";
$major_faculty = "";
$major_degree = "";
$major_course = "";

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $major_id = $_GET['id'];

    $sql = "SELECT * FROM tb_major WHERE major_id = '{$major_id}'";
    $row = row_array($sql);

    $major_name = $row['major_name'];
    $major_faculty = $row['major_faculty'];
    $major_degree = $row['major_degree'];
    $major_course = $row['major_course'];
}

?>

<form action="process/major_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">


    <div class="col-md-12">
        <div class="form-group">
            <label>รหัสหลักสูตร :</label>
            <input type="text" class="form-control" name="major_id" value="<?= $major_id; ?>" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>ชื่อหลักสูตร :</label>
            <input type="text" class="form-control" name="major_name" value="<?= $major_name; ?>" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>คณะของหลักสูตร :</label>
            <input type="text" class="form-control" name="major_faculty" value="<?= $major_faculty; ?>" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>ระดับการศกึษา :</label>
            <input type="text" class="form-control" name="major_degree" value="<?= $major_degree; ?>" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>ระยะเวลาของหลักสูตร (ปี) :</label>
            <input type="text" class="form-control" name="major_course" value="<?= $major_course; ?>" required>
        </div>
    </div>


    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>