<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

$data = array(
    "roomer_status" => $status
);

update("tb_roomer", $data,"roomer_id = {$id}");



if($status > 4){
    $sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$dorm_room_id}' AND roomer_status < 5";
    $cc = result_array($sql);
    $count = count($cc);

    if ($count >= 4) {
        $sql = "UPDATE tb_dorm_room SET dorm_room_status = 0 WHERE dorm_room_id = '{$dorm_room_id}'";
        query($sql);
    } else if ($count == 0) {
        $sql = "UPDATE tb_dorm_room SET dorm_room_status = 1 WHERE dorm_room_id = '{$dorm_room_id}'";
        query($sql);

        $sql = "UPDATE tb_dorm_payment SET show_mydorm = 0 WHERE dorm_room_id = '{$dorm_room_id}'";
        query($sql);

    } else {
        $sql = "UPDATE tb_dorm_room SET dorm_room_status = 2 WHERE dorm_room_id = '{$dorm_room_id}'";
        query($sql);
    }
}




echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

