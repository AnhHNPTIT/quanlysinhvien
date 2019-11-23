<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$sinhvien = $_POST;
	$to = $sinhvien['email'];
	$subject = "[Quản lý sinh viên]";
	$message = $sinhvien['noidung'];
	$headers = "From: voicoixinhgai271297@gmail.com";
	
	header('Content-type: application/json');

	if (mail($to,$subject,$message,$headers)){
		
		echo json_encode(['is' => 'success', 'complete' => 'Đã gửi!']);
	}
	else {
		 echo json_encode(['is' => 'fails', 'uncomplete' => 'Thất bại!']);

}
}
?>