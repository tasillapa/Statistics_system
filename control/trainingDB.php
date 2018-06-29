<?php

@ob_start();
@session_start();
require_once '../connect/connect_db.php';
header("Content-type: application/json;charset=utf-8");
if (isset($_FILES['inputFile']) && !empty($_FILES['inputFile'])) {
//    $file_array = explode(".", $_FILES["inputFile"]["name"]);
    $cn = new connect;
    $cn->con_db();
    $tmpFolder = "../filework/" . $_FILES["inputFile"]["name"];
    move_uploaded_file($_FILES['inputFile']['tmp_name'], $tmpFolder);
    echo $tmpFolder;
    exit();
} else if (isset($_POST["training"]) && !empty($_POST["training"])) {
    $arr = $_POST['training'];
    $cn = new connect;
    $cn->con_db();
    $member_id = $_SESSION['member_id'];
    $sql = "insert into training_form (tf_toppic, tf_name, tf_position, tf_level, tf_date_start, tf_date_end, tf_num, tf_file, member_id)"
            . " values('$arr[0]', '$arr[1]', '$arr[2]', '$arr[3]', '$arr[4]', '$arr[5]', '$arr[6]', '$arr[7]', $member_id)";
    $query = $cn->Connect->query($sql);
    echo $query;
    exit();
}
?>

