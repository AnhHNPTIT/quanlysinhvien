<?php
include_once "connect-to-sql.php";
include_once "constant.php";

echo STUDENT;

session_start();

if(isset($_POST['TenDangNhap'])&&isset($_POST['MatKhau'])) {

  $TenDangNhap = $_POST['TenDangNhap'];
  $MatKhau = $_POST['MatKhau'];

  $sql = "select * from taikhoan where TenDangNhap = '".$TenDangNhap."' and MatKhau = '".$MatKhau."'";
  $result = $connection->query($sql);
  header('Content-type: application/json');
  if ($result->num_rows > 0){
    $taikhoan = $result->fetch_assoc();
    if($taikhoan['NhomQuyen'] == STUDENT){
      $_SESSION['TenDangNhap'] = $TenDangNhap;
      $_SESSION['MaSV'] = $taikhoan['MaSV'];
    } else {
      $_SESSION['TenDangNhap'] = $TenDangNhap;  
      $_SESSION["Admin"] = "Admin";
    }
    
    
  }
  else {
    echo json_encode(['is' => 'fails', 'uncomplete' => 'Thất bại!']); 
  }
}
?>