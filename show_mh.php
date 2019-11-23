<?php 
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
  header("Location: form_login.php");
}
include_once "connect-to-sql.php";
$data = $connection->query("select * from monhoc");
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
        <a class="navbar-brand" href="">Quản lý Sinh Viên</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index_1.php"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["Admin"]; ?>  </a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center text-primary"><b>Danh sách sinh viên</b></h2>
      </div>
      <div class="col-md-12">
        <a href="create-sv.php" type="button" class="btn btn-success">Thêm Sinh Viên</a>
      </div>
    </div>
    <legend></legend>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-striped dataTable" id="myTable">
          <thead>
            <tr>
             <th>Mã sinh viên</th>
             <th>Họ tên</th>
             <th>Ảnh</th>
             <th>Ngày sinh</th>
             <th>Hành động</th>
           </tr>
         </thead>
         <tfoot>
          <tr>
            <th>Mã sinh viên</th>
            <th>Họ tên</th>
            <th>Ảnh</th>
            <th>Ngày sinh</th>
            <th>Hành động</th>
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

              <td><?php $d=strtotime($row['NgaySinh']);
              echo date("d-m-Y", $d); ?></td>
              <td>
                <a href="show-sv.php?detail_sv=<?= $row['MaSV'] ?>" type="button"
                  class="btn btn-success btn-status" title="Xem"><i class="fa fa-stop-circle"></i></a>
                  <a href="edit-sv.php?edit_sv=<?= $row['MaSV'] ?>" type="button" data-id="<?= $row['MaSV']?>" class="btn btn-warning btn-edit" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>
                  <button type="button" data-id="<?= $row['MaSV'] ?>"
                    class="btn btn-danger btn-delete" title="Xoá"><i class="glyphicon glyphicon-trash"></i></button>
                  </td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
        <style>
          tr th{
            text-align: center;
          }
          tr td{
            text-align: center;
          }
        </style>
      </div>
    </div>
  </div>

</body>
<script src="public/js/sweetalert.min.js"></script>
<script src="public/js/jquery.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/datatables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#myTable').DataTable();
  });

  $('.btn-delete').click(function(){
    var _this = $(this);
    var masv = $(this).attr('data-id');
    var form_data = new FormData();
    form_data.append("delete_sv", masv);
    swal({
      title: "Bạn chắc chắn?",
      text: "Bạn có thực sự muốn xóa không?",
      icon: "warning",
      buttons: true,
      buttons: ["Hủy", "Đồng ý"]
    })
    .then(confirm => {
      if(confirm){
        $.ajax({
          type: 'post',
          url : 'delete.php',
          data: form_data,
          contentType: false,
          processData: false,
          success: function(response){
            if(response.is === 'success'){
              _this.parent().parent().remove();
              swal({
                title: response.complete,
                text: "Đã xóa thành công",
                icon: "success"
              })
            }
            if(response.is === 'fails'){
              swal({
                title: response.uncomplete,
                text: "Xóa không thành công",
                icon: "error"
              })
            }
          }
        })
      }
    })
  })

 

</script>
</html>



