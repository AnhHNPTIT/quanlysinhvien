<?php 
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
	header("Location: http://localhost:8888/qlsv/login.php");
}
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link id="ctl00_favicon" rel="shortcut icon" type="image/x-icon" href="http://qldt.ptit.edu.vn/Images/Edusoft.gif">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css"/>
</head>
<body>

  <nav class="navbar navbar-inverse container-fluid">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="http://localhost:8888/qlsv/">Điểm danh</a>
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
        <hr>
        <h2 class="text-center text-primary"><b>Danh sách sinh viên</b></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped dataTable" id="myTable">
          <thead>
            <tr>
             <th>Mã sinh viên</th>
             <th>Họ tên</th>
             <th>Ảnh</th>
             <th>Điểm danh</th>
           </tr>
         </thead>
         <tfoot>
          <tr>
           <th>Mã sinh viên</th>
           <th>Họ tên</th>
           <th>Ảnh</th>
           <th>Điểm danh</th>
         </tr>
       </tfoot>
       <tbody>
         <?php
         if ($data->num_rows > 0) {
          while ($row = $data->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['MaSV'] ?></td>
              <td><?= $row['HoTen'] ?></td>
              <td><img src="<?= $row['Anh'] ?>" style= "width: 100px; height: auto;"/></td>
              <td>
                <div class="form-group">
                  <div class="col-md-4">
                    <select id="kieu_san_pham" name="DiemDanh" class="form-control">
                      <option value="1" >Có mặt</option>
                      <option value="0" >Vắng mặt</option>

                    </select>
                  </div>
                </div>

              </tr>
              <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
    </div>

  </div>
</div>

</body>
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/datatables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>
</html>



