<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$faculty = "";

$extension = array(".jpeg", ".jpg", ".png", ".gif");

if (empty($id)) {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_student" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {

            $data = array(
                "student_code" => $code,
                "student_faculty" => $faculty,
                "major_id" => $major_id,
                "student_title" => $title,
                "student_name" => $name,
                "student_lastname" => $lastname,
                "student_user" => $user,
                "student_password" => $password,
                "student_idcard" => $idcard,
                "student_picture" => $picture_name,
                "student_telephone" => $telephone,
                "student_email" => $email,
                "student_address" => $address,
                "student_date" => date("Y-m-d H:i:s"),
                "delete_data" => 0
            );

            insert("tb_student", $data);

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_student';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง .jpeg|.jpg|.png|.gif เท่านั้น!!');window.history.back();</script>";
        }
    } else {
        $data = array(
            "student_code" => $code,
            "student_faculty" => $faculty,
            "major_id" => $major_id,
            "student_title" => $title,
            "student_name" => $name,
            "student_lastname" => $lastname,
            "student_user" => $user,
            "student_password" => $password,
            "student_idcard" => $idcard,
            "student_picture" => "no.jpg",
            "student_telephone" => $telephone,
            "student_email" => $email,
            "student_address" => $address,
            "student_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        insert("tb_student", $data);

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_student';</script>";
    }
} else {


    $file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
    $picture_name = date('YmdHis') . "_student" . $file_ext;

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
        if (in_array($file_ext, $extension)) {
            $data = array(
                "student_code" => $code,
                "student_faculty" => $faculty,
                "major_id" => $major_id,
                "student_title" => $title,
                "student_name" => $name,
                "student_lastname" => $lastname,
                "student_user" => $user,
                "student_password" => $password,
                "student_idcard" => $idcard,
                "student_picture" => $picture_name,
                "student_telephone" => $telephone,
                "student_email" => $email,
                "student_address" => $address,
                "student_date" => date("Y-m-d H:i:s"),
            );

            update("tb_student", $data, "student_id = {$id}");

            echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_student';</script>";

        } else {
            echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
        }

    } else {

        $data = array(
            "student_code" => $code,
            "student_faculty" => $faculty,
            "major_id" => $major_id,
            "student_title" => $title,
            "student_name" => $name,
            "student_lastname" => $lastname,
            "student_user" => $user,
            "student_password" => $password,
            "student_idcard" => $idcard,
            "student_telephone" => $telephone,
            "student_email" => $email,
            "student_address" => $address,
            "student_date" => date("Y-m-d H:i:s"),
            "delete_data" => 0
        );

        update("tb_student", $data, "student_id = {$id}");

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=user&action=list_student';</script>";
    }
}
?>

