
<?php

//fetch.php;

$data = array();

if(isset($_GET["query"]))
{
 $connect = new PDO("mysql:host=localhost; dbname=qlsv", "root", "");

 $query = "
 SELECT Email FROM sinhvien 
 WHERE Email LIKE '%".$_GET["query"]."%' 
 ORDER BY Email ASC 
 LIMIT 15
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row["Email"];
 }
}

echo json_encode($data);

?>