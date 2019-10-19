<?php
session_start();
include '../function/db_function.php';
$conn = connect();

$idcard = $_POST['idcard'];
$SigCode = $_POST['SigCode'];

$Sql = "UPDATE tb_manager SET signature = '$SigCode' WHERE manager_idcard = '$idcard'";
mysqli_query($conn, $Sql);
$return['Sql'] = $Sql;
$Sql = "UPDATE tb_personnel SET signature = '$SigCode' WHERE personnel_idcard = '$idcard'";
mysqli_query($conn, $Sql);
$return['Sql2'] = $Sql;

echo json_encode($return);
mysqli_close($conn);
die;