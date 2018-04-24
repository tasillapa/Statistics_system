<?php

class connect {

    var $host = "localhost"; //ของผมใช้ localhost ครับ
    var $user = "root"; //""; //username phpmyadmin
    var $pass = "1234"; //""; //password phpmyadmin
    var $db = "db_nso"; //ชื่อฐานข้อมูล//smalldev_mat
    var $Connect;

    function con_db() {
        $this->Connect = mysqli_connect($this->host, $this->user, $this->pass, $this->db)or die("Error : ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
        $charset = "SET character_set_results=UTF8";
        mysqli_query($this->Connect, $charset) or die(mysqli_error($this->Connect));
        $charset = "SET character_set_client='UTF8'";
        mysqli_query($this->Connect, $charset) or die(mysqli_error($this->Connect));
        $charset = "SET character_set_connection='UTF8'";
        mysqli_query($this->Connect, $charset) or die(mysqli_error($this->Connect));
    }
}
?>