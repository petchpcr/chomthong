<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);


$data = array(
    "setting_value" => $status
);

update("tb_setting", $data,"setting_id = 1");

echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

