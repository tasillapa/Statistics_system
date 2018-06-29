<?php

@ob_start();
@session_start();
require_once '../connect/connect_db.php';
header("Content-type: application/json;charset=utf-8");
if (isset($_POST["register"]) && !empty($_POST["register"])) {
    $arr = $_POST['register'];
    $cn = new connect;
    $cn->con_db();
    $sql = "insert into member (username, password, type, numberID, prefix, fname, lname, position, level, department, date, tel, address, claim_id)"
            . " values('$arr[0]', '$arr[1]', '$arr[2]', '$arr[3]', '$arr[4]', '$arr[5]', '$arr[6]', '$arr[7]', '$arr[8]', '$arr[9]', '$arr[10]', '$arr[11]', '$arr[12]', 1)";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
}
else if (isset($_POST["cmY"]) && !empty($_POST["cmY"])) {
    $member_id = $_POST['cmY'];
    $cn = new connect;
    $cn->con_db();
    $sql = "update member set status = 1 where member_id = '$member_id'";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
}
else if (isset($_POST["cmN"]) && !empty($_POST["cmN"])) {
    $member_id = $_POST['cmN'];
    $cn = new connect;
    $cn->con_db();
    $sql = "delete from member where member_id = '$member_id'";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
}
?>

