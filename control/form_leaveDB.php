<?php

@ob_start();
@session_start();
require_once '../connect/connect_db.php';
header("Content-type: application/json;charset=utf-8");
if (!isset($_POST['ERF']) && !isset($_POST['QRF'])) {
    $arr = $_POST['RF'];
    $cn = new connect;
    $cn->con_db();
    $member_id = $_SESSION['member_id'];
    $sql = "insert into request_form (rf_write_place, rf_dateFU, rf_toppic, rf_requst, rf_name, rf_position, rf_level, rf_Codid, rf_department,rf_r2 ,rf_detail, rf_BdateStart_f, rf_AdateStart_f, rf_num_f, rf_r3, rf_BdateStart_p, rf_AdateStart_p, rf_num_p, rf_contact, rf_fhone, member_id)"
            . " values('$arr[0]', '$arr[1]', '$arr[2]', '$arr[3]', '$arr[4]', '$arr[5]', '$arr[6]', '$arr[7]', '$arr[8]', '$arr[9]', '$arr[10]', '$arr[11]', '$arr[12]', '$arr[13]', '$arr[14]', '$arr[15]', '$arr[16]', '$arr[17]', '$arr[18]', '$arr[19]', '$member_id')";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
                    
}
if (!isset($_POST['RF']) && !isset($_POST['QRF'])) {
    $arr = $_POST['ERF'];
    $cn = new connect;
    $cn->con_db();
    $member_id = $_SESSION['member_id'];
    $sql = "insert into emp_req_form (erf_write_place, erf_dateFU, erf_toppic, erf_requst, erf_name, erf_Codid, erf_office, erf_income, erf_BdateStart_f, erf_AdateStart_f, erf_num_f, erf_contact, erf_fhone, member_id)"
            . " values('$arr[0]', '$arr[1]', '$arr[2]', '$arr[3]', '$arr[4]', '$arr[5]', '$arr[6]', '$arr[7]', '$arr[8]', '$arr[9]', '$arr[10]', '$arr[11]', '$arr[12]', '$member_id')";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
                    
}
if (!isset($_POST['RF']) && !isset($_POST['ERF'])) {
    $arr = $_POST['QRF'];
    $cn = new connect;
    $cn->con_db();
    $member_id = $_SESSION['member_id'];
    $sql = "insert into quit_req_form (qrf_write_place, qrf_dateFU, qrf_toppic, qrf_requst, qrf_name, qrf_Codid, qrf_office, qrf_income, qrf_BdateStart_f, qrf_AdateStart_f, qrf_num_f, qrf_contact, qrf_fhone, member_id)"
            . " values('$arr[0]', '$arr[1]', '$arr[2]', '$arr[3]', '$arr[4]', '$arr[5]', '$arr[6]', '$arr[7]', '$arr[8]', '$arr[9]', '$arr[10]', '$arr[11]', '$arr[12]', '$member_id')";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
                    
}
?>

