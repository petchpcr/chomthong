<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_GET);

if($status == 1){
    $data = array(
        "dorm_payment_date_pay" => date("Y-m-d H:i:s")
    );

    update("tb_dorm_payment", $data,"dorm_payment_id = {$id}");
}


$data = array(
    "dorm_payment_status" => $status
);

update("tb_dorm_payment", $data,"dorm_payment_id = {$id}");



echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";
?>

