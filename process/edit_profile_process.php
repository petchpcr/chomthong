<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array(".jpeg", ".jpg", ".png", ".gif");

$file_ext = substr($_FILES["picture"]["name"], strripos($_FILES["picture"]["name"], '.'));
$picture_name = date('YmdHis') . "_edit" . $file_ext;

if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/" . $picture_name)) {
    if (in_array($file_ext, $extension)) {


        if ($status == 4) {

            $data = array(
                "admin_password" => $password,
                "admin_picture" => $picture_name,
                "admin_telephone" => $telephone,
                "admin_email" => $email,
                "admin_address" => $address
            );

            update("tb_admin", $data, "admin_id = {$id}");

        } else if ($status == 3) {
            $data = array(
                "manager_password" => $password,
                "manager_picture" => $picture_name,
                "manager_telephone" => $telephone,
                "manager_email" => $email,
                "manager_address" => $address
            );

            update("tb_manager", $data, "manager_id = {$id}");


        } else if ($status == 2) {
            $data = array(
                "teacher_password" => $password,
                "teacher_picture" => $picture_name,
                "teacher_telephone" => $telephone,
                "teacher_email" => $email,
                "teacher_address" => $address
            );

            update("tb_teacher", $data, "teacher_id = {$id}");

        } else if ($status == 1) {
            $data = array(
                "personnel_password" => $password,
                "personnel_picture" => $picture_name,
                "personnel_telephone" => $telephone,
                "personnel_email" => $email,
                "personnel_address" => $address
            );

            update("tb_personnel", $data, "personnel_id = {$id}");
        } else if ($status == 0) {
            $data = array(
                "student_password" => $password,
                "student_picture" => $picture_name,
                "student_telephone" => $telephone,
                "student_email" => $email,
                "student_address" => $address
            );

            update("tb_student", $data, "student_id = {$id}");
        }

        echo "<meta charset='utf-8'/><script>location.href='../index.php?module=home&action=edit_profile';</script>";

    } else {
        echo "<meta charset='utf-8'/><script>alert('ไฟล์รูปภาพไม่ถูกต้อง jpeg|jpg|png|gif เท่านั้น!!');window.history.back();</script>";
    }

} else {

    if ($status == 4) {
        $data = array(
            "admin_password" => $password,
            "admin_telephone" => $telephone,
            "admin_email" => $email,
            "admin_address" => $address
        );

        update("tb_admin", $data, "admin_id = {$id}");

    } else if ($status == 3) {

        $data = array(
            "manager_password" => $password,
            "manager_telephone" => $telephone,
            "manager_email" => $email,
            "manager_address" => $address
        );

        update("tb_manager", $data, "manager_id = {$id}");

    } else if ($status == 2) {
        $data = array(
            "teacher_password" => $password,
            "teacher_telephone" => $telephone,
            "teacher_email" => $email,
            "teacher_address" => $address
        );

        update("tb_teacher", $data, "teacher_id = {$id}");

    } else if ($status == 1) {
        $data = array(
            "personnel_password" => $password,
            "personnel_telephone" => $telephone,
            "personnel_email" => $email,
            "personnel_address" => $address
        );

        update("tb_personnel", $data, "personnel_id = {$id}");
    } else if ($status == 0) {
        $data = array(
            "student_password" => $password,
            "student_telephone" => $telephone,
            "student_email" => $email,
            "student_address" => $address
        );

        update("tb_student", $data, "student_id = {$id}");
    }

    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=home&action=edit_profile';</script>";
}
?>

