<?php 
session_start();
$output = [];

include_once "connect-to-sql.php";
if(isset($_POST['MonHoc'])){
  $mamh = $_POST['MonHoc'];

  $data = $connection->query("
    SELECT sinhvien.MaSV, sinhvien.HoTen, sinhvien.Anh
    FROM sinhvien
    INNER JOIN svmh
    ON sinhvien.MaSV = svmh.MaSV
    WHERE svmh.MaMH = '" .$mamh. "'");

}
if ($data->num_rows > 0) {
  while ($row = $data->fetch_assoc()) {
   $output[] = array(
    'MaSV' => $row['MaSV'],
    'HoTen'  => $row['HoTen'],
    'Anh'  => $row['Anh']
  );
 }
 echo json_encode($output);
}
?>