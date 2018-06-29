<?php

session_start();
session_unset($_SESSION['member_id']);
session_unset($_SESSION['username']);
session_unset($_SESSION['password']);
session_unset($_SESSION['claim_id']);
session_unset($_SESSION['position']);
session_unset($_SESSION['type']);
session_unset($_SESSION['numberID']);
session_unset($_SESSION['level']);
session_unset($_SESSION['department']);
session_unset($_SESSION['date']);
session_unset($_SESSION['tel']);
session_unset($_SESSION['address']);
session_unset($_SESSION['name']);

unset($_SESSION['member_id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['claim_id']);
unset($_SESSION['position']);
unset($_SESSION['type']);
unset($_SESSION['numberID']);
unset($_SESSION['level']);
unset($_SESSION['department']);
unset($_SESSION['date']);
unset($_SESSION['tel']);
unset($_SESSION['address']);
unset($_SESSION['name']);

session_destroy();
header("Location:../index.php");
?>
