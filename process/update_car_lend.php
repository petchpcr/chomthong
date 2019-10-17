<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

$data = array(
    "car_lend_status" => $status
);

update("tb_car_lend", $data,"car_lend_id = {$id}");

echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

