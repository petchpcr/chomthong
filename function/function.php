<?php

//session
session_start();

function check_session($key)
{
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
}

function check_login($SS, $url)
{
    if (check_session($SS)) {

    } else {
        header('Location:' . $url);
    }
}

function _print_r($arr)
{
    echo '<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />';
    echo '<pre>';
    print_r($arr);
    echo '<pre>';
    exit;
}

function date_th($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function datetime_th($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute น.";
}


function datetime_car_lend($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "<span style='width: 330px;'>$strDay $strMonthThai $strYear</span>เวลา<span style='width: 250px;'>$strHour:$strMinute </span> น.";
}


function status($num)
{
    $status = "ว่าง";

    if ($num == 4) {
        $status = "ผู้ดูแลระบบ";
    } elseif ($num == 3) {
        $status = "ผู้บริหาร";
    } elseif ($num == 2) {
        $status = "อาจารย์";
    } elseif ($num == 1) {
        $status = "บุคลากร";
    } elseif ($num == 0) {
        $status = "นักศึกษา";
    }

    return $status;
}

function get_position_name($id)
{
    $sql = "SELECT * FROM tb_position WHERE position_id = '{$id}'";
    $row = row_array($sql);
    return $row['position_name'];
}

function get_car_type_name($id)
{
    $sql = "SELECT * FROM tb_car_type WHERE car_type_id = '{$id}'";
    $row = row_array($sql);
    return $row['car_type_name'];
}

function car_lend_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "รออนุมัติ";
    } elseif ($num == 1) {
        $status = "รอรับรถ";
    } elseif ($num == 2) {
        $status = "รอคืนรถ";
    } elseif ($num == 3) {
        $status = "เสร็จสิ้น";
    } elseif ($num == 7) {
        $status = "ไม่รับรถ";
    } elseif ($num == 8) {
        $status = "ไม่อนุมัติ";
    } elseif ($num == 9) {
        $status = "ยกเลิก";
    }

    return $status;
}


function maintenance_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "รอรับเรื่อง";
    } elseif ($num == 1) {
        $status = "รอทำเรื่อง";
    } elseif ($num == 2) {
        $status = "รออนุมัติ";
    } elseif ($num == 3) {
        $status = "กำลังดำเนินการ";
    } elseif ($num == 4) {
        $status = "สำเร็จ";
    } elseif ($num == 8) {
        $status = "ไม่รับเรื่อง";
    } elseif ($num == 9) {
        $status = "แก้ไขไม่ได้";
    }

    return $status;
}


function equipment_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "ว่าง";
    } elseif ($num == 1) {
        $status = "ไม่ว่าง";
    }

    return $status;
}


function equipment_lend_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "รออนุมัติ";
    } elseif ($num == 1) {
        $status = "รอรับครุภัณฑ์";
    } elseif ($num == 2) {
        $status = "รอคืนครุภัณฑ์";
    } elseif ($num == 3) {
        $status = "เสร็จสิ้น";
    } elseif ($num == 8) {
        $status = "ไม่อนุมัติ";
    } elseif ($num == 9) {
        $status = "ยกเลิก";
    }

    return $status;
}


function dorm_room_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "ไม่ว่าง";
    } elseif ($num == 1) {
        $status = "ว่าง";
    } elseif ($num == 2) {
        $status = "เหลืออยู่";
    }

    return $status;
}

function car_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "ว่าง";
    } elseif ($num == 1) {
        $status = "ไม่ว่าง";
    }

    return $status;
}

function roomer_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "รออนุมัติ";
    } elseif ($num == 1) {
        $status = "เข้าพัก";
    } elseif ($num == 2) {
        $status = "รออนุมัติย้ายออก";
    } elseif ($num == 3) {
        $status = "รอเวลาย้ายออก";
    } elseif ($num == 8) {
        $status = "ย้ายออก";
    } elseif ($num == 9) {
        $status = "ยกเลิก";
    }

    return $status;
}


function dorm_position($num)
{
    $status = "";

    if ($num == 1) {
        $status = "บุคลากร / อาจารย์";
    } elseif ($num == 0) {
        $status = "นักศึกษา";
    }

    return $status;
}

function dorm_gender($num)
{
    $status = "";

    if ($num == 0) {
        $status = "หอพักรวม";
    } else if ($num == 1) {
        $status = "หอพักชาย";
    } else if ($num == 2) {
        $status = "หอพักหญิง";
    }

    return $status;
}

function get_text_user_id($id)
{
    $data = array();
    $array = explode("-", $id);

    if ($array[0] == "A") {
        $sql = "select * from tb_admin where admin_id = '{$array[1]}'";
        $row = row_array($sql);

        $data['id'] = $row['admin_id'];
        $data['code'] = $id;
        $data['name'] = $row['admin_name'];
        $data['lastname'] = $row['admin_lastname'];
        $data['status'] = 4;

    } elseif ($array[0] == "M") {
        $sql = "select * from tb_manager where manager_id = '{$array[1]}'";
        $row = row_array($sql);

        $data['id'] = $row['manager_id'];
        $data['code'] = $id;
        $data['name'] = $row['manager_name'];
        $data['lastname'] = $row['manager_lastname'];
        $data['status'] = 3;

    } elseif ($array[0] == "T") {
        $sql = "select * from tb_teacher where teacher_id = '{$array[1]}'";
        $row = row_array($sql);

        $data['id'] = $row['teacher_id'];
        $data['code'] = $id;
        $data['name'] = $row['teacher_name'];
        $data['lastname'] = $row['teacher_lastname'];
        $data['status'] = 2;

    } elseif ($array[0] == "P") {
        $sql = "select * from tb_personnel where personnel_id = '{$array[1]}'";
        $row = row_array($sql);

        $data['id'] = $row['personnel_id'];
        $data['code'] = $id;
        $data['name'] = $row['personnel_name'];
        $data['lastname'] = $row['personnel_lastname'];
        $data['status'] = 1;

    } elseif ($array[0] == "S") {
        $sql = "select * from tb_student where student_id = '{$array[1]}'";
        $row = row_array($sql);

        $data['id'] = $row['student_id'];
        $data['code'] = $row['student_code'];
        $data['name'] = $row['student_name'];
        $data['lastname'] = $row['student_lastname'];
        $data['status'] = 0;
    }

    return $data;
}


function dorm_payment_status($num)
{
    $status = "";

    if ($num == 0) {
        $status = "รอชำระเงิน";
    } elseif ($num == 1) {
        $status = "ชำระเงินแล้ว";
    } elseif ($num == 9) {
        $status = "ยกเลิก";
    }

    return $status;
}

function month_name($num)
{
    if ($num == 1) {
        $status = 'มกราคม';
    } elseif ($num == 2) {
        $status = 'กุมภาพันธ์';
    } elseif ($num == 3) {
        $status = 'มีนาคม';
    } elseif ($num == 4) {
        $status = 'เมษายน';
    } elseif ($num == 5) {
        $status = 'พฤษภาคม';
    } elseif ($num == 6) {
        $status = 'มิถุนายน';
    } elseif ($num == 7) {
        $status = 'กรกฎาคม';
    } elseif ($num == 8) {
        $status = 'สิงหาคม';
    } elseif ($num == 9) {
        $status = 'กันยายน';
    } elseif ($num == 10) {
        $status = 'ตุลาคม';
    } elseif ($num == 11) {
        $status = 'พฤศจิกายน';
    } elseif ($num == 12) {
        $status = 'ธันวาคม';
    }

    return $status;
}

function check_datetime_booking_equipment($date_start, $date_end, $time_start, $time_end)
{
    if ($date_start > $date_end) {
        echo "<meta charset='utf-8'/><script>alert('เกิดข้อผิดพลาด!! วันเวลาสิ้นสุดต้องมากกว่าวันที่เริ่มต้น');window.location.href = 'index.php?module=equipment&action=list_equipment_lend';</script>";
        die();
    } elseif ($date_start == $date_end) {
        if ($time_start >= $time_end) {
            echo "<meta charset='utf-8'/><script>alert('เกิดข้อผิดพลาด!! วันเวลาสิ้นสุดต้องมากกว่าวันที่เริ่มต้น');window.location.href = 'index.php?module=equipment&action=list_equipment_lend';</script>";
            die();
        }
    }
}

function check_datetime_booking_car($date_start, $date_end, $time_start, $time_end)
{
    if ($date_start > $date_end) {
        echo "<meta charset='utf-8'/><script>alert('เกิดข้อผิดพลาด!! วันเวลาสิ้นสุดต้องมากกว่าวันที่เริ่มต้น');window.location.href = 'index.php?module=car&action=select_car_lend';</script>";
        die();
    } elseif ($date_start == $date_end) {
        if ($time_start >= $time_end) {
            echo "<meta charset='utf-8'/><script>alert('เกิดข้อผิดพลาด!! วันเวลาสิ้นสุดต้องมากกว่าวันที่เริ่มต้น');window.location.href = 'index.php?module=car&action=select_car_lend';</script>";
            die();
        }
    }
}

function check_car_lend($car_id , $date_start, $date_end, $time_start, $time_end){

    $status = 0;
    $startDT = "{$date_start} {$time_start}:00";
    $endDT = "{$date_end} {$time_end}:00";

    $sql = "SELECT * FROM tb_car_lend WHERE car_id = '{$car_id}' AND car_lend_status < 5 AND ( '{$startDT}' BETWEEN car_lend_starttime AND car_lend_endtime OR '{$endDT}' BETWEEN car_lend_starttime AND car_lend_endtime)";
    $row = row_array($sql);

    if($row){
        $status = 1;
    }

    $sql = "SELECT * FROM tb_car_lend WHERE car_id = '{$car_id}' AND car_lend_status < 5 AND ( car_lend_starttime BETWEEN '{$startDT}' AND '{$endDT}' OR car_lend_endtime BETWEEN '{$startDT}' AND '{$endDT}')";
    $row = row_array($sql);

    if($row){
        $status = 1;
    }

    return $status;

}

function check_driver_car_lend($driver_id , $date_start, $date_end, $time_start, $time_end){

    $status = 0;
    $startDT = "{$date_start} {$time_start}:00";
    $endDT = "{$date_end} {$time_end}:00";

    $sql = "SELECT * FROM tb_car_lend WHERE driver_id = '{$driver_id}' AND car_lend_status < 5 AND ( '{$startDT}' BETWEEN car_lend_starttime AND car_lend_endtime OR '{$endDT}' BETWEEN car_lend_starttime AND car_lend_endtime)";
    $row = row_array($sql);

    if($row){
        $status = 1;
    }

    $sql = "SELECT * FROM tb_car_lend WHERE driver_id = '{$driver_id}' AND car_lend_status < 5 AND ( car_lend_starttime BETWEEN '{$startDT}' AND '{$endDT}' OR car_lend_endtime BETWEEN '{$startDT}' AND '{$endDT}')";
    $row = row_array($sql);

    if($row){
        $status = 1;
    }


    return $status;

}

function check_equipment_lend($equipment_id , $date_start, $date_end, $time_start, $time_end){

    $status = 0;
    $startDT = "{$date_start} {$time_start}:00";
    $endDT = "{$date_end} {$time_end}:00";

    $sql = "SELECT * FROM tb_equipment_lend WHERE equipment_id = '{$equipment_id}' AND equipment_lend_status < 5 AND ( '{$startDT}' BETWEEN equipment_lend_date_start AND equipment_lend_date_return OR '{$endDT}' BETWEEN equipment_lend_date_start AND equipment_lend_date_return)";
    $row = row_array($sql);

    if($row){
        $status = 1;
    }

    $sql = "SELECT * FROM tb_equipment_lend WHERE equipment_id = '{$equipment_id}' AND equipment_lend_status < 5 AND ( equipment_lend_date_start BETWEEN '{$startDT}' AND '{$endDT}' OR equipment_lend_date_return BETWEEN '{$startDT}' AND '{$endDT}')";
    $row = row_array($sql);

    if($row){
        $status = 1;
    }

    return $status;

}



