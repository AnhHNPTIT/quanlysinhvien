<?php 
// output headers so that the file is downloaded rather than displayed

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: csv; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');
// output the column headings
fputcsv($output, array('MaMH', 'TenMH', 'SoTC'));

// fetch the data
include_once"connect-to-sql.php";
$data = $connection->query("SELECT MaMH,TenMH,SoTC FROM monhoc");
if ($data->num_rows > 0) {
	while ($row = $data->fetch_assoc()) {
// loop over the rows, outputting them
		fputcsv($output, $row);
	} 
}
?>

