<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".jpeg", ".jpg", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_personnel" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "personnel_title" => $title,
                "personnel_name" => $name,
                "personnel_lastname" => $lastname,
                "personnel_user" => $user,
                "personnel_password" => $password,
                "personnel_idcard" => $idcard,
                "personnel_picture" => $picture_name,
                "personnel_telephone" => $telephone,
                "personnel_email" => $email,
                "position_id" => $position_id,
                "personnel_address" => $address,
                "personnel_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_personnel", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_personnel';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        $data = array(
            "personnel_title" => $title,
            "personnel_name" => $name,
            "personnel_lastname" => $lastname,
            "personnel_user" => $user,
            "personnel_password" => $password,
            "personnel_idcard" => $idcard,
            "personnel_picture" => "no.jpg",
            "personnel_telephone" => $telephone,
            "personnel_email" => $email,
            "position_id" => $position_id,
            "personnel_address" => $address,
            "personnel_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        insert("tb_personnel", $data);

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_personnel';</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_personnel" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "personnel_title" => $title,
                "personnel_name" => $name,
                "personnel_lastname" => $lastname,
                "personnel_user" => $user,
                "personnel_password" => $password,
                "personnel_idcard" => $idcard,
                "personnel_picture" => $picture_name,
                "personnel_telephone" => $telephone,
                "personnel_email" => $email,
                "position_id" => $position_id,
                "personnel_address" => $address,
                "personnel_date" => date("Y-m-d H:i:s"),
            );

            update("tb_personnel", $data, "personnel_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_personnel';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "personnel_title" => $title,
            "personnel_name" => $name,
            "personnel_lastname" => $lastname,
            "personnel_user" => $user,
            "personnel_password" => $password,
            "personnel_idcard" => $idcard,
            "personnel_telephone" => $telephone,
            "personnel_email" => $email,
            "position_id" => $position_id,
            "personnel_address" => $address,
            "personnel_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        update("tb_personnel", $data, "personnel_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_personnel';</script>";
    }
}
?>

