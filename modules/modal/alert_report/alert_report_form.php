

<form action="process/report_process.php" method="post" enctype="multipart/form-data">


    <div class="col-md-12">
        <div class="form-group">
            <label>หัวข้อ :</label>
            <input type="text" class="form-control" name="report_topic" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>คำร้องเรียน :</label>
            <textarea name="report_detail" rows="3" class="form-control" required></textarea>
        </div>
    </div>



    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>
</form>