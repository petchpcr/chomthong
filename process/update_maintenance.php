<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

$data = array(
    "maintenance_status" => $status
);

update("tb_maintenance", $data,"maintenance_id = {$id}");

echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

