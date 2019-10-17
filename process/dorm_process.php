<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".jpeg", ".jpg", ".JPG", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_dorm" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "dorm_position" => $position,
                "dorm_name" => $name,
                "dorm_price" => $price,
                "dorm_picture" => $picture_name,
                "dorm_detail" => $detail,
                "dorm_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_dorm", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=dorm&action=list_dorm';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_dorm" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "dorm_position" => $position,
                "dorm_name" => $name,
                "dorm_price" => $price,
                "dorm_picture" => $picture_name,
                "dorm_detail" => $detail,
                "dorm_date" => date("Y-m-d H:i:s")
            );

            update("tb_dorm", $data, "dorm_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=dorm&action=list_dorm';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "dorm_position" => $position,
            "dorm_name" => $name,
            "dorm_price" => $price,
            "dorm_detail" => $detail,
            "dorm_date" => date("Y-m-d H:i:s")
        );

        update("tb_dorm", $data, "dorm_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=dorm&action=list_dorm';</script>";
    }
}
?>

