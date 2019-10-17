<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array("jpeg", "jpg", "png", "gif" , "JPG" , "PNG");


if (empty($id)) {


    $data = array(
        "dorm_room_name" => $name,
        "dorm_room_detail" => $detail,
        "dorm_room_status" => 1,
        "dorm_room_date" => date("Y-m-d"),
        "dorm_id" => $dorm_id,
        "delete_data" => 0
    );

    insert("tb_dorm_room", $data);


    $max = row_array('SELECT MAX(dorm_room_id) as max FROM tb_dorm_room;');
    $id = $max['max'];

    foreach ($_FILES["img"]["tmp_name"] as $key => $tmp_name) {
        $file_name = $_FILES["img"]["name"][$key];
        $file_tmp = $_FILES["img"]["tmp_name"][$key];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($ext, $extension)) {

            $filename = basename($file_name, $ext);
            $newFileName = $key."dorm_room_".date('YmdHis') .".". $ext;
            if(move_uploaded_file($file_tmp = $_FILES["img"]["tmp_name"][$key], "../uploads/" . $newFileName)){
                $arr = array(
                    "dorm_room_id" => $id,
                    "dorm_room_img_name" => $newFileName
                );

                insert("tb_dorm_room_img",$arr);
            }

        } else {
            array_push($error, "$file_name, ");
        }
    }


    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=dorm&action=list_dorm_room&dorm_id={$dorm_id}';</script>";

} else {


    $data = array(
        "dorm_room_name" => $name,
        "dorm_room_detail" => $detail,
        "dorm_room_date" => date("Y-m-d"),
        "dorm_id" => $dorm_id
    );

    update("tb_dorm_room", $data, "dorm_room_id = {$id}");

    foreach ($_FILES["img"]["tmp_name"] as $key => $tmp_name) {
        $file_name = $_FILES["img"]["name"][$key];
        $file_tmp = $_FILES["img"]["tmp_name"][$key];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($ext, $extension)) {

            $filename = basename($file_name, $ext);
            $newFileName = $key."dorm_room_".date('YmdHis') .".". $ext;
            if(move_uploaded_file($file_tmp = $_FILES["img"]["tmp_name"][$key], "../uploads/" . $newFileName)){
                $arr = array(
                    "dorm_room_id" => $id,
                    "dorm_room_img_name" => $newFileName
                );

                insert("tb_dorm_room_img",$arr);
            }

        } else {
            array_push($error, "$file_name, ");
        }
    }

    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=dorm&action=list_dorm_room&dorm_id={$dorm_id}';</script>";
}
?>

