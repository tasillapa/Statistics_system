<?php

@ob_start();
@session_start();
require_once '../connect/connect_db.php';
header("Content-type: application/json;charset=utf-8");
if (isset($_POST["rfY"]) && !empty($_POST["rfY"])) {
    $val = $_POST['rfY'];
    $note = $_POST['note'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE request_form SET rf_note = '$note', rf_status = '1' WHERE rf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["rfN"]) && !empty($_POST["rfN"])) {
    $val = $_POST['rfN'];
    $note = $_POST['note'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE request_form SET rf_note = '$note', rf_status = '2' WHERE rf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["qrfY"]) && !empty($_POST["qrfY"])) {
    $val = $_POST['qrfY'];
    $note = $_POST['note'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE quit_req_form SET qrf_note = '$note', qrf_status = '1' WHERE qrf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["qrfN"]) && !empty($_POST["qrfN"])) {
    $val = $_POST['qrfN'];
    $note = $_POST['note'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE quit_req_form SET qrf_note = '$note', qrf_status = '2' WHERE qrf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["erfY"]) && !empty($_POST["erfY"])) {
    $val = $_POST['erfY'];
    $note = $_POST['note'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE emp_req_form SET erf_note = '$note', erf_status = '1' WHERE erf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["erfN"]) && !empty($_POST["erfN"])) {
    $val = $_POST['erfN'];
    $note = $_POST['note'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE emp_req_form SET erf_note = '$note', erf_status = '2' WHERE erf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
}
?>

