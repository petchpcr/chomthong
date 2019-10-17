
<?PHP
extract($_GET);
?>

<form action="process/room_out_process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="roomer_id" value="<?= $roomer_id ?>">


    <div class="col-md-12">
        <div class="form-group">
            <label>วันที่ออก :</label>
            <input type="date" class="form-control" name="date" required>
        </div>
        <p style="color: red;">
            หมายเหตุ : เมื่อคุณยืนยันแล้วไม่สามารถยกเลิกการแจ้งออกได้
        </p>
    </div>

    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
    </div>
</form>


