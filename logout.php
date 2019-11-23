<?php
session_start();
unset($_SESSION["TenDangNhap"]);
unset($_SESSION["MatKhau"]);
header("Location: form_login.php");
?>