<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

$data = array(
    "delete_data" => 1
);
update($table,$data ,"{$ff} = {$id}");

echo"<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";








?>

