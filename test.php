
<!DOCTYPE html>
<html>
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
	<form method="POST">
		<select name="GioiTinh">
			<option value="Nam" >Nam</option>
			<option value="Nữ">Nữ</option>
		</select>
		<input type="submit">
		</form>

<?php
	
    $gender = $_POST['GioiTinh'];
    echo $gender;


?>
</body>
</html>