<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);


if (empty($dorm_payment_id)) {


    $data = array(
        "dorm_payment_price" => $dorm_payment_price,
        "dorm_payment_electric" => $dorm_payment_electric,
        "dorm_payment_water" => $dorm_payment_water,
        "dorm_payment_other" => $dorm_payment_other,
        "dorm_payment_msg" => $dorm_payment_msg,
        "dorm_payment_month" => $dorm_payment_month,
        "dorm_payment_year" => $dorm_payment_year,
        "dorm_payment_date_invoice" => date("Y-m-d H:i:s"),
        "dorm_room_id" => $dorm_room_id,
        "dorm_payment_status" => 0
    );

    insert("tb_dorm_payment", $data);

    echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";

} else {


    $data = array(
        "dorm_payment_price" => $dorm_payment_price,
        "dorm_payment_electric" => $dorm_payment_electric,
        "dorm_payment_water" => $dorm_payment_water,
        "dorm_payment_other" => $dorm_payment_other,
        "dorm_payment_msg" => $dorm_payment_msg,
        "dorm_payment_month" => $dorm_payment_month,
        "dorm_payment_year" => $dorm_payment_year,
        "dorm_room_id" => $dorm_room_id
    );

    update("tb_dorm_payment", $data, "dorm_payment_id = {$dorm_payment_id}");

    echo "<meta charset='utf-8'/><script>window.location.href = document.referrer;</script>";

}
?>

