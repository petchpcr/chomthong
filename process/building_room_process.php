<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);


if (empty($id)) {


    $data = array(
        "building_room_name" => $name,
        "building_room_type" => $type,
        "building_room_detail" => $detail,
        "building_id" => $building_id,
        "delete_data" => 0
    );

    insert("tb_building_room", $data);

    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=building&action=list_building_room&building_id={$building_id}';</script>";

} else {


    $data = array(
        "building_room_name" => $name,
        "building_room_detail" => $detail,
        "building_id" => $building_id,
        "building_room_type" => $type
    );

    update("tb_building_room", $data, "building_room_id = {$id}");

    echo "<meta charset='utf-8'/><script>location.href='../index.php?module=building&action=list_building_room&building_id={$building_id}';</script>";
}
?>

