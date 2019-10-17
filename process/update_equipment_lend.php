<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

$data = array(
    "equipment_lend_status" => $status
);

update("tb_equipment_lend", $data,"equipment_lend_id = {$id}");

echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

