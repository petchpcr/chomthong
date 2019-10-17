<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$extension = array("jpeg", "jpg", "png", "gif" , "JPG" , "PNG");


$data = array(
    "maintenance_list" => $maintenance_list,
    "maintenance_detail" => $maintenance_detail,
    "maintenance_place" => $maintenance_place,
    "maintenance_msg" => $maintenance_msg,
    "maintenance_type_id" => $maintenance_type_id,
    "maintenance_pdf" => "",
    "maintenance_price" => 0,
    "maintenance_status" => 0,
    "repairer_id" => $_SESSION['id'],
    "maintenance_date" => date("Y-m-d H:i:s")
);

insert("tb_maintenance", $data);

$max = row_array('SELECT MAX(maintenance_id) as max FROM tb_maintenance;');
$id = $max['max'];

foreach ($_FILES["img"]["tmp_name"] as $key => $tmp_name) {
    $file_name = $_FILES["img"]["name"][$key];
    $file_tmp = $_FILES["img"]["tmp_name"][$key];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    if (in_array($ext, $extension)) {

        $filename = basename($file_name, $ext);
        $newFileName = $key."maintenance_".date('YmdHis') .".". $ext;
        if(move_uploaded_file($file_tmp = $_FILES["img"]["tmp_name"][$key], "../uploads/" . $newFileName)){
            $arr = array(
                "maintenance_id" => $id,
                "maintenance_img_name" => $newFileName
            );

            insert("tb_maintenance_img",$arr);
        }

    }
}


echo "<meta charset='utf-8'/><script>location.href='../index.php?module=maintenance&action=list_maintenance';</script>";
?>

