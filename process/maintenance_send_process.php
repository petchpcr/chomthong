<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".PDF", ".pdf");

$send_id = check_session('id');

$file_ext = substr($_FILES["pdf"]["name"], strripos($_FILES["pdf"]["name"], '.'));
$pdf_name = date('YmdHis') . "_maintenance" . $file_ext;

if (move_uploaded_file($_FILES["pdf"]["tmp_name"], "../uploads/" . $pdf_name)) {
    if (in_array($file_ext, $extension)) {

        $data = array(
            "maintenance_price" => $maintenance_price,
            "maintenance_pdf" => $pdf_name,
            "maintenance_status" => 2,
            "send_id" => $send_id,
            "maintenance_date_send" => date("Y-m-d H:i:s")
        );

        update("tb_maintenance", $data , "maintenance_id = '{$maintenance_id}'");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=maintenance&action=maintenance_send';</script>";

    } else {
        echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .pdfเท่านั้น!!');window.history.back();</script>";
    }
} else {
    $data = array(
        "maintenance_price" => $maintenance_price,
        "maintenance_status" => 2,
        "send_id" => $send_id,
        "maintenance_date_send" => date("Y-m-d H:i:s")
    );

    update("tb_maintenance", $data , "maintenance_id = '{$maintenance_id}'");

    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=maintenance&action=maintenance_send';</script>";
}
?>

