<?php

include '../function/db_function.php';
include '../function/function.php';


extract($_POST);
$data = array(
    "report_topic" => $report_topic,
    "report_detail" => $report_detail,
    "report_date" => date("Y-m-d H:i:s"),
    "reportder_id" => check_session('id')
);

insert("tb_report", $data);

echo "<meta charset='utf-8'/><script>location.href='../index.php?module=alert_report&action=my_alert_report';</script>";

?>

