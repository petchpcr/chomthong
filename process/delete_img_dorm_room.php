<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);


delete("tb_dorm_room_img" , "dorm_room_img_id = '{$id}'");

echo"<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";








?>

