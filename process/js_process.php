<?php
session_start();
include '../function/db_function.php';
include '../function/function.php';
$conn = connect();

// ======================================== Dorm ========================================
function get_floor($conn, $DATA)
{
  $dorm = $DATA["dorm"];
  $count = 0;
  $Sql = "SELECT DISTINCT SUBSTRING(dorm_room_name,1,1) AS xFloor
          FROM tb_dorm_room 
          WHERE dorm_id LIKE '%$dorm%'";

  $meQuery = mysqli_query($conn, $Sql);
  while ($Result = mysqli_fetch_assoc($meQuery)) {
    $return['xFloor'][$count] = $Result['xFloor'];
    $count++;
  }
  $return['cnt'] = $count;

  if ($count > 0) {
    $return['status'] = "success";
  } else {
    $return['status'] = "failed";
  }
  $return['form'] = "get_floor";
  echo json_encode($return);
  mysqli_close($conn);
  die;
}

// ======================================== Car ========================================
function get_car_by_type($conn, $DATA)
{
  if ($DATA["Type"] == null) {
    $Type = "";
  } else {
    $Type = "WHERE car_type_id = " . $DATA["Type"];
  }
  $count = 0;
  $Sql = "SELECT car_id,car_licence FROM tb_car " . $Type . " ORDER BY car_licence ASC";
  $meQuery = mysqli_query($conn, $Sql);
  while ($Result = mysqli_fetch_assoc($meQuery)) {
    $return['car_id'][$count] = $Result['car_id'];
    $return['car_licence'][$count] = $Result['car_licence'];
    $count++;
  }
  $return['cnt'] = $count;

  if ($count > 0) {
    $return['status'] = "success";
  } else {
    $return['status'] = "failed";
  }
  $return['form'] = "get_car_by_type";
  echo json_encode($return);
  mysqli_close($conn);
  die;
}



if (isset($_POST['DATA'])) {
  $data = $_POST['DATA'];
  $DATA = json_decode(str_replace('\"', '"', $data), true);

  if ($DATA['STATUS'] == 'logout') {
    logout($conn, $DATA);
  } else if ($DATA['STATUS'] == 'get_floor') {
    get_floor($conn, $DATA);
  } else if ($DATA['STATUS'] == 'get_car_by_type') {
    get_car_by_type($conn, $DATA);
  }
} else {
  $return['status'] = "error";
  echo json_encode($return);
  mysqli_close($conn);
  die;
}
