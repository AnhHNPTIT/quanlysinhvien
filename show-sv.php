<?php
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
    header("Location: form_login.php");
}
include_once "connect-to-sql.php";

if (isset($_GET['detail_sv'])) {
    $detail_sv = $_GET['detail_sv'];
    $detail_sinhvien = $connection->query("SELECT * FROM sinhvien WHERE MaSV = '" . $detail_sv . "'");
    if ($detail_sinhvien->num_rows <= 0) {
        header("Location: index.php");
    }
    $detail_sinhvien = $detail_sinhvien->fetch_assoc();
    $lop = $connection->query("SELECT * FROM lop WHERE MaLop = '" . $detail_sinhvien['MaLop'] . "'")->fetch_assoc();
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thông tin sinh viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="ctl00_favicon" rel="shortcut icon" type="image/x-icon" href="http://qldt.ptit.edu.vn/Images/Edusoft.gif">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="public/css/detail_product.css"/>
</head>
<body>

  <nav class="navbar navbar-inverse container-fluid">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="">Quản lý Sinh Viên</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
<li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["Admin"]; ?>  </a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-primary"><b>Thông tin sinh viên</b></h2>
        </div>
    </div>
    <legend></legend>
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img src="<?= $detail_sinhvien['Anh']?>"/></div>
                    </div>
                </div>
                <div class="details col-md-6">
                    <p class="price" style="color: red;font-size: xx-large;"><?= $detail_sinhvien['HoTen']?></p>
                    <h3 class="">Mã sinh viên: <b><?= $detail_sinhvien['MaSV']?></b></h3>
                    <h3 class="">Giới tính: <b><?= $detail_sinhvien['GioiTinh'] ?></b></h3>
                    <h3 class="">Ngày sinh: <b><?php $d=strtotime($detail_sinhvien['NgaySinh']);
                    echo date("d-m-Y", $d); ?></b></span></h3>
                    <h3 class="">Quê quán: <b><?= $detail_sinhvien['QueQuan'] ?></b></h3>
                    <h3 class="">Email: <b><?= $detail_sinhvien['Email'] ?></b></h3>
                    <h3 class="">Lớp: <b><?= $lop['TenLop'] ?></b></h3><br>
                    <a href="qlsv.php"><button type="button" class="btn btn-primary">Quay lại</button></a>
                </div>
            </div>
        </div>

    </div>

</body>
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
</html>
