<?php

include '../function/db_function.php';
include '../function/function.php';

extract($_POST);

$position = 0;

$sql = "select * from tb_admin where admin_user = '{$username}' AND admin_password = '{$password}'";
$row = row_array($sql);

if($row > 0){
    $id = "A-".$row['admin_id'];
    $name = $row['admin_name'];
    $picture = $row['admin_picture'];
    $position = $row['position_id'];
    $status = 4;
    $url = 'index.php';

}else{
    $sql = "select * from tb_manager where manager_user = '{$username}' AND manager_password = '{$password}' and delete_data = 0";
    $row = row_array($sql);

    if($row){
        $id = "M-".$row['manager_id'];
        $name = $row['manager_name']." ".$row['manager_lastname'];
        $picture = $row['manager_picture'];
        $position = $row['position_id'];
        $status = 3;
        $url = 'index.php';
    }else{
        $sql = "select * from tb_teacher where teacher_user = '{$username}' AND teacher_password = '{$password}' and delete_data = 0";
        $row = row_array($sql);

        if($row){
            $id = "T-".$row['teacher_id'];
            $name = $row['teacher_name']." ".$row['teacher_lastname'];
            $picture = $row['teacher_picture'];
            $position = $row['position_id'];
            $status = 2;
            $url = 'index.php';
        }else{
            $sql = "select * from tb_personnel where personnel_user = '{$username}' AND personnel_password = '{$password}' and delete_data = 0";
            $row = row_array($sql);

            if($row){
                $id = "P-".$row['personnel_id'];
                $name = $row['personnel_name']." ".$row['personnel_lastname'];
                $picture = $row['personnel_picture'];
                $position = $row['position_id'];
                $status = 1;
                $url = 'index.php';
            }else{
                $sql = "select * from tb_student where student_user = '{$username}' AND student_password = '{$password}' and delete_data = 0";
                $row = row_array($sql);

                if($row){
                    $id = "S-".$row['student_id'];
                    $name = $row['student_name']." ".$row['student_lastname'];
                    $picture = $row['student_picture'];
                    $status = 0;
                    $url = 'index.php';
                }else{
                    echo"<meta charset='utf-8'/><script>alert('ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง!!');location.href='../login.php';</script>";
                    die();
                }
            }
        }
    }
}

$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['picture'] = $picture;
$_SESSION['status'] = $status;
$_SESSION['position'] = $position;


echo"<meta charset='utf-8'/><script>location.href='../{$url}';</script>";
