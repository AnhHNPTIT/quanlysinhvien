<?php
session_start();
unset($_SESSION["TenDangNhap"]);
unset($_SESSION["MatKhau"]);
header("Location: http://localhost:8888/qlsv/login.php");
?>