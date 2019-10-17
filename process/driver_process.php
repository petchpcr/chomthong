<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".jpeg", ".jpg", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_driver" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "driver_title" => $title,
                "driver_name" => $name,
                "driver_lastname" => $lastname,
                "driver_idcard" => $idcard,
                "driver_picture" => $picture_name,
                "driver_telephone" => $telephone,
                "driver_address" => $address,
                "driver_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_driver", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=list_driver';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        $data = array(
            "driver_title" => $title,
            "driver_name" => $name,
            "driver_lastname" => $lastname,
            "driver_idcard" => $idcard,
            "driver_picture" => "no.jpg",
            "driver_telephone" => $telephone,
            "driver_address" => $address,
            "driver_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        insert("tb_driver", $data);

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=list_driver';</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_driver" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "driver_title" => $title,
                "driver_name" => $name,
                "driver_lastname" => $lastname,
                "driver_idcard" => $idcard,
                "driver_picture" => $picture_name,
                "driver_telephone" => $telephone,
                "driver_address" => $address,
                "driver_date" => date("Y-m-d H:i:s")
            );


            update("tb_driver", $data, "driver_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=list_driver';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "driver_title" => $title,
            "driver_name" => $name,
            "driver_lastname" => $lastname,
            "driver_idcard" => $idcard,
            "driver_telephone" => $telephone,
            "driver_address" => $address,
            "driver_date" => date("Y-m-d H:i:s")
        );


        update("tb_driver", $data, "driver_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=list_driver';</script>";
    }
}
?>

