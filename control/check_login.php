<?php

@ob_start();
@session_start();
require_once '../connect/connect_db.php';
header("Content-type: application/json;charset=utf-8");
$cn = new connect;
$cn->con_db();
$sql = "select * from member where username='" . $_POST["username"] . "' and password='" . $_POST["password"] . "' and status = '1'";
$query = $cn->Connect->query($sql);
if (mysqli_num_rows($query) >= 1) {
    while ($rs = mysqli_fetch_array($query)) {
        $_SESSION['member_id'] = $rs['member_id'];
        $_SESSION['username'] = $rs['username'];
        $_SESSION['password'] = $rs['password'];
        $_SESSION['claim_id'] = $rs['claim_id'];
        $_SESSION['position'] = $rs['position'];
        $_SESSION['type'] = $rs['type'];
        $_SESSION['numberID'] = $rs['numberID'];
        $_SESSION['level'] = $rs['level'];
        $_SESSION['department'] = $rs['department'];
        $_SESSION['date'] = $rs['date'];
        $_SESSION['tel'] = $rs['tel'];
        $_SESSION['address'] = $rs['address'];
        $_SESSION['name'] = $rs['prefix'].$rs['fname'] . ' ' . $rs['lname'];
    }
    if ($_SESSION['claim_id'] == '1') {
        header('Location: ../main/calendar.php');
        end();
    }
    if ($_SESSION['claim_id'] == '2') {
        header('Location: ../main/calendar.php');
        end();
    }
    if ($_SESSION['claim_id'] == '3') {
        header('Location: ../main/calendar.php');
        end();
    }
} else {
// <script>alert("ไม่มีรหัสผู้ใช้ กรุณาติดต่อเจ้าหน้าที่เพื่อขอรับรหัวผู้ใช้งาน!!"); location.href="../main/login.php";</script>;
   
    header('Location: ../main/login.php');
    end();
}
?>

