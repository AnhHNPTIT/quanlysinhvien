<?php
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
  header("Location: http://localhost:8888/qlsv/login.php");
} 
include_once "connect-to-sql.php";
$data = $connection->query("select * from monhoc");?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        <a class="navbar-brand" href="http://localhost:8888/qlsv/">Quản lý môn học</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index_1.php"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["Admin"]; ?>  </a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
      </ul>
    </div>
  </nav>


</fieldset>
</form>
<hr>
<div class="col-md-12">
  <h2 class="text-center text-primary"><b>Danh sách môn học</b></h2>
</div>
</div>

</div>
</div>

<div class="container">
 <div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-striped dataTable" id="myTable">
      <thead>
        <tr>
         <th>Mã môn học</th>
         <th>Tên môn học</th>
         <th>Số tín chỉ</th>
         <th>Hành động</th>
       </tr>
     </thead>
     <tfoot>
      <tr>
        <th>Mã môn học</th>
        <th>Tên môn học</th>
        <th>Số tín chỉ</th>
        <th>Hành động</th>
      </tr>
    </tfoot>
    <tbody>
     <?php
     if ($data->num_rows > 0) {
      while ($row = $data->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['MaMH'] ?></td>
          <td><?= $row['TenMH'] ?></td>
          <td><?= $row['SoTC'] ?></td>
          <td>
                <a href="#" type="button"
                  class="btn btn-success btn-status" title="Xem"><i class="fa fa-stop-circle"></i></a>
                  <a href="#" type="button" data-id="<?= $row['MaSV']?>" class="btn btn-warning btn-edit" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>
                  <button type="button" data-id="#"
                    class="btn btn-danger btn-delete" title="Xoá"><i class="glyphicon glyphicon-trash"></i></button>
                  </td>
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
<hr>
<div id="wrap">
  <div class="container">
    <div class="row">
      <form class="form-horizontal" name="upload_excel" enctype="multipart/form-data">
        <fieldset>
          <!-- File Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="filebutton">Chọn file</label>
            <div class="col-md-4">
              <input type="file" name="file" id="file" class="input-large">
            </div>
          </div>
          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
            <div class="col-md-4">
              <button type="button" class="btn btn-primary" id="btn-send">Import</button>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton">Export data</label>
            <div class="col-md-4">
              <a href="demo_export.php"><button type="button" class="btn btn-primary" id="btn-down">Export</button></a>
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

          $('#btn-send').click(function(){
            var _this = $(this);
            var form_data = new FormData();
            form_data.append("file", $('input[type=file]')[0].files[0]);

            $.ajax({
              type: 'POST',
              url: 'import-mh.php',
              data: form_data,
              contentType: false,
              processData: false,
              success: function(response){
                if(response.is === 'success'){
                  swal({
                    title: response.complete,
                    text: "Đã import môn học thành công",
                    icon: "success"
                  })
                }
                if(response.is === 'fails'){
                  swal({
                    title: response.uncomplete,
                    text: "Import không thành công",
                    icon: "error"
                  })
                }
              }
            })
          })
</script>
</html>