<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);


$data = array(
    "roomer_date" => date('Y-m-d H:i:s'),
    "dorm_room_id" => $id,
    "roomer_status" => 9
);

update("tb_roomer", $data, "roomer_id = '{$roomer_id}'");

$sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$id}' AND roomer_status < 5";
$cc = result_array($sql);
$count = count($cc);

if ($count >= 4) {
    $sql = "UPDATE tb_dorm_room SET dorm_room_status = 0 WHERE dorm_room_id = '{$id}'";
    query($sql);
} elseif ($count == 0) {
    $sql = "UPDATE tb_dorm_room SET dorm_room_status = 1 WHERE dorm_room_id = '{$id}'";
    query($sql);
} else {
    $sql = "UPDATE tb_dorm_room SET dorm_room_status = 2 WHERE dorm_room_id = '{$id}'";
    query($sql);
}



echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

