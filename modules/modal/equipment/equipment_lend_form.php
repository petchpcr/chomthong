<?PHP
extract($_GET);
?>

<form action="process/equipment_lend_process.php" method="post" enctype="multipart/form-data" class="row">
    <input type="hidden" name="equipment_id" value="<?= $_GET['equipment_id'] ?>">

    <div class="col-md-12">
        <div class="form-group">
            <label>รายละเอียด :</label>
            <textarea name="equipment_lend_objective" class="form-control" placeholder="กรุณากรอกวัตถุประสงค์เพื่อนำไปใช้งาน" required></textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>วันที่เริ่มต้น :</label>
            <input type="date" class="form-control" name="equipment_lend_date_start" value="<?=$date_start;?>" readonly>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>วันที่สิ้นสุด :</label>
            <input type="date" class="form-control" name="equipment_lend_date_return" value="<?=$date_end;?>" readonly>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>เวลาเริ่มต้น :</label>
            <input type="time" class="form-control" name="time_start" value="<?=$time_start?>" readonly>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>เวลาสิ้นสุด :</label>
            <input type="time" class="form-control" name="time_end" value="<?=$time_end;?>" readonly>
        </div>
    </div>

    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>

</form>