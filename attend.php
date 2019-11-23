<?php 
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
  header("Location: form_login.php");
}
include_once "connect-to-sql.php";
$MonHoc = $connection->query("select * from monhoc");
$data = $connection->query("select * from sinhvien");


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
        <a class="navbar-brand" href="attend.php">Điểm danh</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index_ad.php"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["Admin"]; ?>  </a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <form id="add_details">
      <div class="form-group">
        <label class="col-md-4 control-label" for="kieu_san_pham" style="font-size: 25px">Môn học</label>
        <div class="col-md-4">
          <select id="monhoc" name="MonHoc" class="form-control">
            <option value=" ">----- Chọn lớp học -----</option>
            <?php foreach ($MonHoc as $type): ?>
              <option value="<?= $type['MaMH'] ?>"><?= $type['TenMH'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <button id ="btn-send" name="add" type="button" class="btn btn-success">Điểm danh</button>
      </div>
    </form>
    
  </div>

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
       <tbody id = "table_data">
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

  $(document).ready(function(){
     $('#btn-send').click(function(){
        if($('#monhoc').val() != " "){
            $.ajax({
             type: "POST",
             url: "get_sv.php",
             data: {"MonHoc": $('#monhoc').val()},
             success: function(response){
                var html = '';  
                if(response){
                  var data = JSON.parse(response);
                  for (key in data){
                     html += '<tr>';
                     html += '<td>'+data[key].MaSV+'</td>';
                     html += '<td>'+data[key].HoTen+'</td>';
                     html += '<td><img src="'+data[key].Anh+'" style= "width: 100px; height: auto;"/></td>';
                     html += '<td>';
                     html += '<div class="form-group">';
                     html += '<div class="col-md-4">';
                     html += '<select id="kieu_san_pham" name="DiemDanh" class="form-control">';
                     html += '<option value="1" >Có mặt</option>';
                     html += '<option value="0" >Vắng mặt</option>';
                     html += '</select>';
                     html += '</div>';
                     html += '</div>';
                     html += '</td>';
                  }
                  $("#table_data tr").remove(); 
                  $('#table_data').append(html);
                }
                else{
                  $("#table_data tr").remove(); 
                  swal({
                      title: "Danh sách trống",
                      text: "Chưa có sinh viên",
                      icon: "warning"
                  })
                }
              }
            })
        }
        else{
          swal({
              title: "Thất bại!",
              text: "Vui lòng chọn lớp học",
              icon: "error"
          })
        }
     })
  });
</script>
</html>



