<?php
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
    header("Location: form_login.php");
}
include_once "connect-to-sql.php";
$lop = $connection->query("SELECT * FROM lop");

if (isset($_POST['submit'])){

    $sinhvien = $_POST;

    if (isset($_FILES['Anh']['name'])){
        $target_file = "public/images/" . 'img_'.date('Y-m-d-H-s').'.png';
        if (move_uploaded_file($_FILES["Anh"]["tmp_name"], $target_file))
            $sinhvien['Anh'] = $target_file;
    }
    $sql = "INSERT INTO sinhvien VALUES 
    ('".$sinhvien['MaSV']."','".$sinhvien['HoTen']."','".$sinhvien['GioiTinh']."','".$sinhvien['NgaySinh']."','".$sinhvien['QueQuan']."','".$sinhvien['Email']."','".$sinhvien['MaLop']."','".$sinhvien['Anh']."')";

    if ($connection->query($sql)){
        header("Location: create-sv.php");
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
                <li><a href="index_ad.php"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["Admin"]; ?></a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary"><b>Thêm sinh viên</b></h2>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <form class="form-horizontal" enctype="multipart/form-data">
                    <fieldset>
                        <legend></legend>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="masv">Mã sinh viên</label>
                            <div class="col-md-4">
                                <input id="masv" name="MaSV" class="form-control input-md"
                                required="" type="text">
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="hoten">Họ tên</label>
                            <div class="col-md-4">
                                <input id="hoten" name="HoTen" class="form-control input-md"
                                required="" type="text">
                            </div>
                        </div>
                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="gioitinh">Giới tính</label>
                            <div class="col-md-4">
                                <select id="gioitinh" name="GioiTinh" class="form-control">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ngaysinh">Ngày sinh</label>
                            <div class="col-md-4">
                                <input id="ngaysinh" name="NgaySinh" class="form-control input-md"
                                required="" type="date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="quequan">Quê Quán</label>
                            <div class="col-md-4">
                                <input id="quequan" name="QueQuan" class="form-control input-md"
                                required="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email</label>
                            <div class="col-md-4">
                                <input id="email" name="Email" class="form-control input-md"
                                required="" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="malop">Lớp</label>
                            <div class="col-md-4">
                                <select id="malop" name="MaLop" class="form-control">
                                    <?php foreach ($lop as $type): ?>
                                        <option value="<?= $type['MaLop'] ?>"><?= $type['TenLop'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        
                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="anh">Hình ảnh</label>
                            <div class="col-md-4">
                                <div class="col-md-4">
                                    <input id="anh" name="Anh" class="input-file" type="file">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <button type="button" class="btn btn-primary" id="btn-create">Thêm mới</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="public/js/sweetalert.min.js"></script>
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script>
    $('#btn-create').click(function(){
        var _this = $(this);
        var form_data = new FormData();
        form_data.append("MaSV", $('#masv').val());
        form_data.append("HoTen", $('#hoten').val());
        form_data.append("GioiTinh", $('#gioitinh').val());
        form_data.append("NgaySinh", $('#ngaysinh').val());
        form_data.append("QueQuan", $('quequan').val());
        form_data.append("Email", $('#email').val());
        form_data.append("MaLop", $('#malop').val());
        form_data.append("Anh", $('input[type=file]')[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'create.php',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                if(response.is === 'success'){
                  swal({
                    title: response.complete,
                    text: "Đã thêm thành công",
                    icon: "success"
                })
              }
              if(response.is === 'fails'){
                  swal({
                    title: response.uncomplete,
                    text: "Thêm không thành công",
                    icon: "error"
                })
              }
          }
      })
    })
</script>
</html>



