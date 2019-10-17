<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);

$data = array(
    "roomer_date_out" => $date,
    "roomer_status" => 2
);

update("tb_roomer", $data,"roomer_id = {$roomer_id}");


echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

