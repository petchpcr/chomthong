<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);



$data = array(
    "equipment_id" => $equipment_id,
    "lender_id" => $_SESSION['id'],
    "equipment_lend_objective" => $equipment_lend_objective,
    "equipment_lend_date_start" => $equipment_lend_date_start . " " .$time_start,
    "equipment_lend_date_return" => $equipment_lend_date_return . " " .$time_end,
    "equipment_lend_date" => date("Y-m-d H:i:s"),
    "equipment_lend_status" => 0
);

insert("tb_equipment_lend", $data);

echo "<meta charset='utf-8'/><script>location.href='../index.php?module=equipment&action=my_equipment_lend';</script>";
?>

