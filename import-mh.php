<?php 
include_once"connect-to-sql.php";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once __DIR__.'/vendor/SimpleXLSX.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	header('Content-type: application/json');
	if (isset($_FILES['file'])) {
		$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

		if(in_array($_FILES["file"]["type"],$allowedFileType)){
			if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) ) {
				foreach ( $xlsx->rows() as $k => $r ) {
					if($r[0] != ''){
						$sql = $connection->query("insert into monhoc values('".$r[0]."','".$r[1]."','".$r[2]."')");
					}	
				}
				echo json_encode(['is' => 'success', 'complete' => 'Đã thêm!']);
			} 
		 	else {
			echo SimpleXLSX::parseError();
			}
		}
		else{
			echo json_encode(['is' => 'fails', 'uncomplete' => 'Thất bại!']);
		}
	}

	else {	
		echo json_encode(['is' => 'fails', 'uncomplete' => 'Thất bại!']);	
	}
}

?>  