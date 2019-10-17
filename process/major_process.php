<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);


if (empty($id)) {

    $sql = "SELECT * FROM tb_major WHERE major_id = '{$major_id}'";
    $check = row_array($sql);

    if($check){
        echo"<meta charset='utf-8'/><script>alert('รหัสหลักสูตรนี้มีในระบบแล้ว!!');window.history.back();</script>";
        die();
    }



    $data = array(
        "major_id" => $major_id,
        "major_name" => $major_name,
        "major_faculty" => $major_faculty,
        "major_degree" => $major_degree,
        "major_course" => $major_course,
        "delete_data" => 0
    );

    insert("tb_major", $data);

    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=major&action=list_major';</script>";

} else {


    $sql = "SELECT * FROM tb_major WHERE major_id = '{$major_id}' AND major_id != '{$id}'";
    $check = row_array($sql);

    if($check){
        echo"<meta charset='utf-8'/><script>alert('รหัสหลักสูตรนี้มีในระบบแล้ว!!');window.history.back();</script>";
        die();
    }


    $data = array(
        "major_id" => $major_id,
        "major_name" => $major_name,
        "major_faculty" => $major_faculty,
        "major_degree" => $major_degree,
        "major_course" => $major_course
    );

    update("tb_major", $data, "major_id = {$id}");

    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=major&action=list_major';</script>";
}
?>

