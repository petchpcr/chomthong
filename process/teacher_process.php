<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".jpeg", ".jpg", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_teacher" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "teacher_title" => $title,
                "teacher_name" => $name,
                "teacher_lastname" => $lastname,
                "teacher_user" => $user,
                "teacher_password" => $password,
                "teacher_idcard" => $idcard,
                "teacher_picture" => $picture_name,
                "teacher_telephone" => $telephone,
                "teacher_email" => $email,
                "position_id" => $position_id,
                "teacher_address" => $address,
                "teacher_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_teacher", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_teacher';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        $data = array(
            "teacher_title" => $title,
            "teacher_name" => $name,
            "teacher_lastname" => $lastname,
            "teacher_user" => $user,
            "teacher_password" => $password,
            "teacher_idcard" => $idcard,
            "teacher_picture" => "no.jpg",
            "teacher_telephone" => $telephone,
            "teacher_email" => $email,
            "position_id" => $position_id,
            "teacher_address" => $address,
            "teacher_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        insert("tb_teacher", $data);

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_teacher';</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_teacher" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "teacher_title" => $title,
                "teacher_name" => $name,
                "teacher_lastname" => $lastname,
                "teacher_user" => $user,
                "teacher_password" => $password,
                "teacher_idcard" => $idcard,
                "teacher_picture" => $picture_name,
                "teacher_telephone" => $telephone,
                "teacher_email" => $email,
                "position_id" => $position_id,
                "teacher_address" => $address,
                "teacher_date" => date("Y-m-d H:i:s"),
            );

            update("tb_teacher", $data, "teacher_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_teacher';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "teacher_title" => $title,
            "teacher_name" => $name,
            "teacher_lastname" => $lastname,
            "teacher_user" => $user,
            "teacher_password" => $password,
            "teacher_idcard" => $idcard,
            "teacher_telephone" => $telephone,
            "teacher_email" => $email,
            "position_id" => $position_id,
            "teacher_address" => $address,
            "teacher_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        update("tb_teacher", $data, "teacher_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_teacher';</script>";
    }
}
?>

