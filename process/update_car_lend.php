<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);
$user_idcard = 1;

$data = array(
    "car_lend_status" => $status,
    "user_approve" => $user_idcard
);

update("tb_car_lend", $data,"car_lend_id = {$id}");

echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

