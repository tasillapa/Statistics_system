<?php

@ob_start();
@session_start();
require_once '../connect/connect_db.php';
header("Content-type: application/json;charset=utf-8");
if (isset($_POST["GETRF"]) && !empty($_POST["GETRF"])) {
    $cn = new connect;
    $cn->con_db();
    $sql = "SELECT * FROM request_form WHERE rf_status = '1';";
    $query = $cn->Connect->query($sql);
    $array = array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row);
    }
    echo json_encode($array);
    exit();
} else if (isset($_POST["GETERF"]) && !empty($_POST["GETERF"])) {
    $cn = new connect;
    $cn->con_db();
    $sql = "SELECT * FROM emp_req_form WHERE erf_status = '1';";
    $query = $cn->Connect->query($sql);
    $array = array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row);
    }
    echo json_encode($array);
    exit();
} else if (isset($_POST["GETQRF"]) && !empty($_POST["GETQRF"])) {
    $cn = new connect;
    $cn->con_db();
    $sql = "SELECT * FROM quit_req_form WHERE qrf_status = '1';";
    $query = $cn->Connect->query($sql);
    $array = array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row);
    }
    echo json_encode($array);
    exit();
} else if (isset($_POST["qrfN"]) && !empty($_POST["qrfN"])) {
    $val = $_POST['qrfN'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE quit_req_form SET qrf_status = '2' WHERE qrf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["erfY"]) && !empty($_POST["erfY"])) {
    $val = $_POST['erfY'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE emp_req_form SET erf_status = '1' WHERE erf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["erfN"]) && !empty($_POST["erfN"])) {
    $val = $_POST['erfN'];
    $cn = new connect;
    $cn->con_db();
    $sql = "UPDATE emp_req_form SET erf_status = '2' WHERE erf_id = '$val';";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["addWorkboss"]) && !empty($_POST["addWorkboss"])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $cn = new connect;
    $cn->con_db();
    $sql = "INSERT INTO table_work_boss (twb_title, twb_start, twb_end) VALUES('$title', '$start', '$end')";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
} else if (isset($_POST["GETWB"]) && !empty($_POST["GETWB"])) {
    $cn = new connect;
    $cn->con_db();
    $sql = "SELECT * FROM table_work_boss;";
    $query = $cn->Connect->query($sql);
    $array = array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row);
    }
    echo json_encode($array);
    exit();
}
?>

