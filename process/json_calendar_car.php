<?php
include '../function/db_function.php';
include '../function/function.php';


$red = "#ff4d4d";


$data = array();


$sql = "SELECT * FROM tb_car_lend a inner join tb_car b on a.car_id = b.car_id inner join tb_driver d on a.driver_id = d.driver_id where car_lend_status < 5  ";
$result = result_array($sql);

foreach ($result as $i=>$row) {

    $status = car_lend_status($row['car_lend_status']);
    $car_type = get_car_type_name($row['car_type_id']);

    $color = $red;


    $data[$i]['id'] = $i + 1;
    $data[$i]['name'] = "[{$status}] [{$row['car_licence']}] รถ{$car_type} สถานที่ : {$row['car_lend_place']}";
    $data[$i]['startdate'] = $row['car_lend_starttime'];
    $data[$i]['enddate'] = $row['car_lend_endtime'];
    $data[$i]['color'] = $color;
    $data[$i]['url'] = "";
}


$data['monthly'] = $data;


echo json_encode($data, JSON_NUMERIC_CHECK);

?>