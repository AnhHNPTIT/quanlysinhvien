<?php
session_start();
if (!isset($_SESSION['TenDangNhap'])) {
    header("Location: http://localhost:8888/qlsv/login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gửi thông báo</title>
        <link id="ctl00_favicon" rel="shortcut icon" type="image/x-icon" href="http://qldt.ptit.edu.vn/Images/Edusoft.gif">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    </head>
    <body>
<nav class="navbar navbar-inverse container-fluid">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://localhost:8888/qlsv/email.php">Gửi thông báo</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index_1.php"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["Admin"]; ?></a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary"><b>Gửi thông báo</b></h2>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <form class="form-horizontal" enctype="multipart/form-data">
                    <fieldset>
                        <legend></legend>
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="noidung">Nội dung</label>
                            <div class="col-md-7">
                                <textarea class="form-control" id="noidung" name="noidung" required="" style= "    height: 150px;"></textarea>
                            </div>
                        </div>

                    
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="search_data">Email</label>
                            <div class="col-md-7">
                                <input type="email" id="search_data" name = "search_data" placeholder="" autocomplete="off" class="form-control input-lg" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-6 col-md-4">
                                <button type="button" class="btn btn-primary" id="btn-send">Gửi đi</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>


    
    </body>
</html>
<script src="public/js/sweetalert.min.js"></script>
<script>
  $(document).ready(function(){
      
    $('#search_data').tokenfield({
        autocomplete :{
            source: function(request, response)
            {
                jQuery.get('get-email.php', {
                    query : request.term
                }, function(data){
                    data = JSON.parse(data);
                    response(data);
                });
            },
            delay: 100
        }
    });
});


    $('#btn-send').click(function(){
        var _this = $(this);
        var form_data = new FormData();
       
        form_data.append("noidung", $('#noidung').val());
        form_data.append("email", $('#search_data').val());

        $.ajax({
            type: 'POST',
            url: 'send-mail.php',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                if(response.is === 'success'){
                  swal({
                    title: response.complete,
                    text: "Đã gửi thành công",
                    icon: "success"
                })
              }
              if(response.is === 'fails'){
                  swal({
                    title: response.uncomplete,
                    text: "Gửi không thành công",
                    icon: "error"
                })
              }
          }
      })
  })

</script>
