<?php

session_start();
session_unset($_SESSION['member_id']);
session_unset($_SESSION['username']);
session_unset($_SESSION['password']);
session_unset($_SESSION['claim_id']);
session_unset($_SESSION['position']);
session_unset($_SESSION['name']);

unset($_SESSION['member_id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['claim_id']);
unset($_SESSION['position']);
unset($_SESSION['name']);

session_destroy();
header("Location:../index.php");
?>
