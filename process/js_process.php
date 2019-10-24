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

function Evidence_pay($conn, $DATA)
{
  $pay_id = $DATA["dorm_pay_id"];
  $return['dorm_pay_id'] = $pay_id;
  $Sql = "SELECT evidence_img 
          FROM tb_dorm_payment 
          WHERE dorm_payment_id = '$pay_id'";

  $meQuery = mysqli_query($conn, $Sql);
  $Result = mysqli_fetch_assoc($meQuery);
  $return['evidence_img'] = $Result['evidence_img'];


  if (isset($Result['evidence_img'])) {
    $return['status'] = "success";
  } else {
    $return['status'] = "failed";
  }
  $return['form'] = "Evidence_pay";
  echo json_encode($return);
  mysqli_close($conn);
  die;
}

function Evidence_save($conn, $DATA)
{
  $pay_id = $DATA["dorm_pay_id"];

  $Sql = "SELECT evidence_img 
          FROM tb_dorm_payment 
          WHERE dorm_payment_id = '$pay_id'";

  $meQuery = mysqli_query($conn, $Sql);
  $Result = mysqli_fetch_assoc($meQuery);
  $unfile = "../uploads/" . $Result['evidence_img'];
  unlink($unfile);

  $LastName = explode('.', $_FILES['file']['name']);
  $FileName = 'DP_' . date('YmdHis') . '.' . $LastName[1];
  move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/' . $FileName);

  $Sql = "UPDATE tb_dorm_payment 
          SET evidence_img = '$FileName' 
          WHERE dorm_payment_id = '$pay_id'";

  $return['unfile'] = $unfile;
  $return['FileName'] = $FileName;
  if (mysqli_query($conn, $Sql)) {
    $return['status'] = "success";
  } else {
    $return['status'] = "failed";
  }
  $return['form'] = "Evidence_save";
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

// ======================================== Dorm ========================================
function get_qeuip_type($conn, $DATA)
{
  $e_type = $DATA["type"];
  $count = 0;
  $Sql = "SELECT equipment_id AS xEquip ,equipment_name AS nEquip
          FROM tb_equipment 
          WHERE equipment_type LIKE '%$e_type%'";

  $meQuery = mysqli_query($conn, $Sql);
  while ($Result = mysqli_fetch_assoc($meQuery)) {
    $return['xEquip'][$count] = $Result['xEquip'];
    $return['nEquip'][$count] = $Result['nEquip'];
    $count++;
  }
  $return['cnt'] = $count;

  if ($count > 0) {
    $return['status'] = "success";
  } else {
    $return['status'] = "failed";
  }
  $return['form'] = "get_qeuip_type";
  echo json_encode($return);
  mysqli_close($conn);
  die;
}

// ======================================== Signature ========================================
function user_sign($conn, $DATA)
{
  $idcard = $DATA["idcard"];
  $return['idcard'] = $idcard;
  $boolean = false;
  $Sql = "SELECT manager_name AS sign_name,
                  manager_lastname AS sign_Lname,
                  manager_picture AS picture,
                  signature 
          FROM tb_manager 
          WHERE manager_idcard = '$idcard'

          UNION ALL 
          
          SELECT personnel_name AS sign_name,
                  personnel_lastname AS sign_Lname,
                  personnel_picture AS picture,
                  signature 
          FROM tb_personnel 
          WHERE personnel_idcard = '$idcard'";

  $meQuery = mysqli_query($conn, $Sql);
  while ($Result = mysqli_fetch_assoc($meQuery)) {
    $return['sign_name'] = $Result['sign_name'];
    $return['sign_Lname'] = $Result['sign_Lname'];
    $return['picture'] = $Result['picture'];
    $return['signature'] = $Result['signature'];
    $boolean = true;
  }

  if ($boolean) {
    $return['status'] = "success";
  } else {
    $return['status'] = "failed";
  }
  $return['form'] = "user_sign";
  echo json_encode($return);
  mysqli_close($conn);
  die;
}

function del_sign($conn, $DATA)
{
  $idcard = $DATA["idcard"];
  $Sql = "UPDATE tb_manager SET signature = null WHERE manager_idcard = '$idcard'";
  mysqli_query($conn, $Sql);
  $Sql = "UPDATE tb_personnel SET signature = null WHERE personnel_idcard = '$idcard'";
  mysqli_query($conn, $Sql);

  $return['status'] = "success";
  $return['form'] = "del_sign";
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
  } else if ($DATA['STATUS'] == 'Evidence_pay') {
    Evidence_pay($conn, $DATA);
  } else if ($DATA['STATUS'] == 'Evidence_save') {
    Evidence_save($conn, $DATA);
  } else if ($DATA['STATUS'] == 'get_car_by_type') {
    get_car_by_type($conn, $DATA);
  } else if ($DATA['STATUS'] == 'get_qeuip_type') {
    get_qeuip_type($conn, $DATA);
  } else if ($DATA['STATUS'] == 'user_sign') {
    user_sign($conn, $DATA);
  } else if ($DATA['STATUS'] == 'del_sign') {
    del_sign($conn, $DATA);
  }
} else {
  $return['status'] = "error";
  echo json_encode($return);
  mysqli_close($conn);
  die;
}
