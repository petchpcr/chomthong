<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$code = "";
$faculty = "";
$major_id = 0;

$extension = array(".jpeg", ".jpg", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_car" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "car_licence" => $licence,
                "car_type_id" => $type,
                "car_brand" => $brand,
                "car_model" => $model,
                "car_sit" => $sit,
                "car_color" => $color,
                "car_picture" => $picture_name,
                "car_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_car", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=list_car';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_car" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "car_licence" => $licence,
                "car_type_id" => $type,
                "car_brand" => $brand,
                "car_sit" => $sit,
                "car_model" => $model,
                "car_color" => $color,
                "car_picture" => $picture_name,
                "car_date" => date("Y-m-d H:i:s")
            );

            update("tb_car", $data, "car_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=list_car';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "car_licence" => $licence,
            "car_type_id" => $type,
            "car_sit" => $sit,
            "car_brand" => $brand,
            "car_model" => $model,
            "car_color" => $color,
            "car_date" => date("Y-m-d H:i:s")
        );

        update("tb_car", $data, "car_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=list_car';</script>";
    }
}
