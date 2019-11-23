<?php
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
  header("Location: login.php");
}
include_once "connect-to-sql.php";

$lop = $connection->query("select * from lop");
if (isset($_GET['edit_sv'])) {
    $edit_sv = $_GET['edit_sv'];
    $edit_sinhvien = $connection->query("select * from sinhvien where MaSV = '" . $edit_sv . "'");
    if ($edit_sinhvien->num_rows <= 0) {
        header("Location: index.php");
    }
    $edit_sinhvien = $edit_sinhvien->fetch_assoc();
}
if (isset($_POST['submit'])) {

    $sinhvien = $_POST;

    if (isset($_FILES['Anh']['name']) && $_FILES['Anh']['name'] != '') {
        $target_file = "public/images/" . 'img_' . date('Y-m-d-H-s') . '.png';
        if (move_uploaded_file($_FILES["Anh"]["tmp_name"], $target_file))
            $sinhvien['Anh'] = $target_file;

        if ($edit_sinhvien['Anh'] != '') {
            unlink($edit_sinhvien['Anh']);
        }

    }
    $sql = "update sinhvien set HoTen = '" . $sinhvien['HoTen'] . "', GioiTinh= '" . $sinhvien['GioiTinh'] . "', 
    NgaySinh= '" . $sinhvien['NgaySinh'] . "', QueQuan= '" . $sinhvien['QueQuan'] . "', 
    Email= '" . $sinhvien['Email'] . "' , MaLop= '" . $sinhvien['MaLop'] . "', Anh= '" . $sinhvien['Anh'] . "' where MaSV = '" . $edit_sv . "'";

    if ($connection->query($sql)) {
        header("Location: edit-sv.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="ctl00_favicon" rel="shortcut icon" type="image/x-icon" href="http://qldt.ptit.edu.vn/Images/Edusoft.gif">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
</head>
<body>

 <nav class="navbar navbar-inverse container-fluid">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="">Quản lý Sinh Viên</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["Admin"]; ?></a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-primary"><b>Sửa sinh viên</b></h2>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-md-12">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend></legend>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_name">Mã sinh viên</label>
                        <div class="col-md-4">
                            <input disabled id="product_name" name="MaSV" class="form-control input-md"
                            required="" type="text" value="<?= $edit_sinhvien['MaSV'] ?>">
                        </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_name">Họ tên</label>
                        <div class="col-md-4">
                            <input id="product_name" name="HoTen" class="form-control input-md"
                            required="" type="text" value="<?= $edit_sinhvien['HoTen'] ?>">
                        </div>
                    </div>
                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="kieu_san_pham">Giới tính</label>
                        <div class="col-md-4">
                            <select id="kieu_san_pham" name="GioiTinh" class="form-control">
                                <option value="Nam" <?= ($edit_sinhvien['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
                                <option value="Nữ" <?= ($edit_sinhvien['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="tutorial">Ngày sinh</label>
                        <div class="col-md-4">
                            <input id="gia" name="NgaySinh" class="form-control input-md"
                            required="" type="date" value="<?= $edit_sinhvien['NgaySinh'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="tutorial">Quê Quán</label>
                        <div class="col-md-4">
                            <input id="gia" name="QueQuan" class="form-control input-md"
                            required="" type="text" value="<?= $edit_sinhvien['QueQuan'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="tutorial">Email</label>
                        <div class="col-md-4">
                            <input id="gia" name="Email" class="form-control input-md"
                            required="" type="email" value="<?= $edit_sinhvien['Email'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="kieu_san_pham">Lớp</label>
                        <div class="col-md-4">
                            <select id="kieu_san_pham" name="MaLop" class="form-control">
                                <?php foreach ($lop as $type): ?>
                                    <option value="<?= $type['MaLop'] ?>" <?= ($edit_sinhvien['MaLop'] == $type['MaLop']) ? 'selected' : '' ?> ><?= $type['TenLop'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="">Hình ảnh</label>
                        <div class="col-md-4">
                            <div class="col-md-4">
                                <input id="hinh_anh" name="Anh" class="input-file" type="file" value="<?= $edit_sinhvien['Anh'] ?>">
                            </div>
                        </div>
                        <?php if ($edit_sinhvien['Anh'] != ''): ?>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="tutorial"></label>
                                <div class="col-md-4">
                                    <img style="width: 100px" src="<?= $edit_sinhvien['Anh'] ?>" alt="">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <button name="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="index.php"><button type="button" class="btn btn-primary">Hủy</button></a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

</body>
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
</html>



