<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

$renter_id = check_session('id');

$sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$id}' AND roomer_status < 5";
$cc = result_array($sql);
$count = count($cc);

if ($count > 4) {
    echo "<meta charset='utf-8'/><script>alert('คุณมาช้าไป!! ห้องนี้เต็มแล้ว');window.location.href = document.referrer;</script>";
    die();
}

$sql = "SELECT * FROM tb_roomer where renter_id = '{$renter_id}' AND roomer_status < 5 AND dorm_room_id = '{$id}'";
$row = row_array($sql);

if ($row) {
    echo "<meta charset='utf-8'/><script>alert('เกิดข้อผิดพลาด!! คุณได้อยู่ในรายชื่อผู้เช่าเรียบร้อยแล้ว');window.location.href = document.referrer;</script>";
    die();
}

$data = array(
    "roomer_date" => date('Y-m-d H:i:s'),
    "dorm_room_id" => $id,
    "roomer_status" => 0
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

$sql = "SELECT * FROM tb_roomer where dorm_room_id = '{$dorm_room_id_old}' AND roomer_status < 5";
$cc = result_array($sql);
$count = count($cc);

if ($count >= 4) {
    $sql = "UPDATE tb_dorm_room SET dorm_room_status = 0 WHERE dorm_room_id = '{$dorm_room_id_old}'";
    query($sql);
} elseif ($count == 0) {
    $sql = "UPDATE tb_dorm_room SET dorm_room_status = 1 WHERE dorm_room_id = '{$dorm_room_id_old}'";
    query($sql);
} else {
    $sql = "UPDATE tb_dorm_room SET dorm_room_status = 2 WHERE dorm_room_id = '{$dorm_room_id_old}'";
    query($sql);
}

echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

