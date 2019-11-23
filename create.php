<?php 
include_once "connect-to-sql.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$sinhvien = $_POST;
	$sinhvien['Anh'] = '';
	if (isset($_FILES['Anh']) && $_FILES['Anh']['name'] != ' '){
		$target_file = "public/images/" . 'img_'.date('Y-m-d-H-s').'.png';
		if (move_uploaded_file($_FILES["Anh"]["tmp_name"], $target_file))
			$sinhvien['Anh'] = $target_file;
	}
	$sql = "INSERT INTO sinhvien VALUES 
	('".$sinhvien['MaSV']."','".$sinhvien['HoTen']."','".$sinhvien['GioiTinh']."','".$sinhvien['NgaySinh']."','".$sinhvien['QueQuan']."','".$sinhvien['Email']."','".$sinhvien['MaLop']."','".$sinhvien['Anh']."')";
		header('Content-type: application/json');
	if ($connection->query($sql)){
		echo json_encode(['is' => 'success', 'complete' => 'Đã thêm!']);
	}
	else {
		echo json_encode(['is' => 'fails', 'uncomplete' => 'Thất bại!']);	
	}

}
?>