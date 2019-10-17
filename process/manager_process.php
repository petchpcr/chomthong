<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".jpeg", ".jpg", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_manager" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "manager_title" => $title,
                "manager_name" => $name,
                "manager_lastname" => $lastname,
                "manager_user" => $user,
                "manager_password" => $password,
                "manager_idcard" => $idcard,
                "manager_picture" => $picture_name,
                "manager_telephone" => $telephone,
                "manager_email" => $email,
                "position_id" => $position_id,
                "manager_address" => $address,
                "manager_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_manager", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_manager';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        $data = array(
            "manager_title" => $title,
            "manager_name" => $name,
            "manager_lastname" => $lastname,
            "manager_user" => $user,
            "manager_password" => $password,
            "manager_idcard" => $idcard,
            "manager_picture" => "no.jpg",
            "manager_telephone" => $telephone,
            "manager_email" => $email,
            "position_id" => $position_id,
            "manager_address" => $address,
            "manager_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        insert("tb_manager", $data);

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_manager';</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_manager" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "manager_title" => $title,
                "manager_name" => $name,
                "manager_lastname" => $lastname,
                "manager_user" => $user,
                "manager_password" => $password,
                "manager_idcard" => $idcard,
                "manager_picture" => $picture_name,
                "manager_telephone" => $telephone,
                "manager_email" => $email,
                "position_id" => $position_id,
                "manager_address" => $address,
                "manager_date" => date("Y-m-d H:i:s"),
            );

            update("tb_manager", $data, "manager_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_manager';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "manager_title" => $title,
            "manager_name" => $name,
            "manager_lastname" => $lastname,
            "manager_user" => $user,
            "manager_password" => $password,
            "manager_idcard" => $idcard,
            "manager_telephone" => $telephone,
            "manager_email" => $email,
            "position_id" => $position_id,
            "manager_address" => $address,
            "manager_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        update("tb_manager", $data, "manager_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_manager';</script>";
    }
}
?>

