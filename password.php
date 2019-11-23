<?php
include_once "connect-to-sql.php";
include_once "constant.php";
header('Content-type: application/json');

session_start();
$newpassword = $_POST['newpassword'];
$renewpassword = $_POST['renewpassword'];
if($newpassword != $renewpassword){
  echo json_encode(['is' => 'fails', 'mess' => 'Mật khẩu không khớp']);
}
else{
  if (isset($_SESSION['MaSV'])) {
    $MaSV = $_SESSION['MaSV'];
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];

    $sql = "UPDATE taikhoan SET MatKhau = '". $newpassword ."' where MaSV = '".$MaSV."'";
    $result = $connection->query($sql);
    if($result){
      echo json_encode(['is' => 'success', 'mess' => 'Đã thay đổi mật khẩu!']);
    }
    else {
      echo json_encode(['is' => 'fails', 'mess' => 'Thay đổi không thành công!']);
    }
  }
}
?>