<?php 
include_once "connect-to-sql.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['delete_sv'])) {
		$delete_sv = $_POST['delete_sv'];
		$delete_sinhvien = $connection->query("SELECT * FROM sinhvien WHERE MaSV = '" . $delete_sv . "'");

		if ($delete_sinhvien->num_rows <= 0) {
			echo json_encode(['is' => 'fails', 'uncomplete' => 'Thất bại!']);
		}
		$delete_sinhvien = $delete_sinhvien->fetch_assoc();
		if ($delete_sinhvien['Anh'] != '') {
			unlink($delete_sinhvien['Anh']);
		}

		$flag1 = $connection->query("DELETE FROM sinhvien WHERE MaSV = '".$delete_sinhvien['MaSV']. "'");
		$flag2 = $connection->query("DELETE FROM taikhoan WHERE MaSV = '" .$delete_sinhvien['MaSV']. "'");
		header('Content-type: application/json');
		if($flag1 && $flag2){
			echo json_encode(['is' => 'success', 'complete' => 'Đã xoá!']);
		}
		else{
			echo json_encode(['is' => 'fails', 'uncomplete' => 'Thất bại!']);	
		}
		
	}

}
?>