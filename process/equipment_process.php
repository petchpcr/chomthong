<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".jpeg", ".jpg", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_equipment" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "equipment_code" => $code,
                "equipment_name" => $name,
                "equipment_category" => $category,
                "equipment_type" => $type,
                "building_room_id" => $building_room_id,
                "equipment_picture" => $picture_name,
                "equipment_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_equipment", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=equipment&action=list_equipment';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_equipment" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "equipment_code" => $code,
                "equipment_name" => $name,
                "equipment_category" => $category,
                "equipment_type" => $type,
                "building_room_id" => $building_room_id,
                "equipment_picture" => $picture_name
            );

            update("tb_equipment", $data, "equipment_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=equipment&action=list_equipment';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "equipment_code" => $code,
            "equipment_name" => $name,
            "equipment_category" => $category,
            "equipment_type" => $type,
            "building_room_id" => $building_room_id,
            "equipment_date" => date("Y-m-d H:i:s")
        );


        update("tb_equipment", $data, "equipment_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=equipment&action=list_equipment';</script>";

    }
}


?>

