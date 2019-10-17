<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);
$reservations_id = check_session("id");



$data = array(
    "car_id" => $car_id,
    "driver_id" => $driver_id,
    "reservations_id" => $reservations_id,
    "car_lend_people" => $car_lend_people,
    "car_lend_place" => $car_lend_place,
    "car_lend_objective" => $car_lend_objective,
    "car_lend_starttime" => $car_lend_starttime . " " .$time_start,
    "car_lend_endtime" => $car_lend_endtime . " " .$time_end,
    "car_lend_date" => date("Y-m-d H:i:s"),
    "car_lend_status" => 0
);

insert("tb_car_lend", $data);

echo "<meta charset='utf-8'/><script>location.href='../index.php?module=car&action=my_car_lend';</script>";
?>

