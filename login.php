<?php
include_once "connect-to-sql.php";
session_start();

if (isset($_POST['TenDangNhap'])&&isset($_POST['MatKhau'])) {

  $TenDangNhap = $_POST['TenDangNhap'];
  $MatKhau = $_POST['MatKhau'];

  $sql = "select * from taikhoan where TenDangNhap = '".$TenDangNhap."' and MatKhau = '".$MatKhau."'";
  $result = $connection->query($sql);

  if ($result->num_rows > 0){
    $taikhoan = $result->fetch_assoc();
    $_SESSION['message_success'] = "Đăng nhập thành công!";
    if($taikhoan['NhomQuyen'] == 1){
      $_SESSION['TenDangNhap'] = $TenDangNhap;
      $_SESSION['MaSV'] = $taikhoan['MaSV'];
      header("Location: http://localhost:8888/qlsv/index_sv.php");
    } else {
      $_SESSION['TenDangNhap'] = $TenDangNhap;  
      $_SESSION["Admin"] = "Admin";
      header("Location: http://localhost:8888/qlsv/index_ad.php");
    }
    
    
  }else{
    $_SESSION['message_error'] = "Tài khoản hoặc mật khẩu không chính xác!";

    echo $_SESSION['message_error'];


  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link id="ctl00_favicon" rel="shortcut icon" type="image/x-icon" href="http://qldt.ptit.edu.vn/Images/Edusoft.gif">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom styles for this template-->
  <link href="public/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
             <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
             <div class="col-lg-6"> 
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                </div>
                <form class="user" action="" method="POST">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="TenDangNhap" placeholder="Tên đăng nhập">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="MatKhau" placeholder="Mật khẩu">
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label" for="customCheck">Nhớ mật khẩu</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button id = "btn-login" type="button" class="btn btn-primary">Đăng nhập</button>
                  </div>
                  <hr>
                </form>
                <div class="text-center">
                  <a class="small" href="forgot-password.html">Quên mật khẩu?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

</body>

</html>
