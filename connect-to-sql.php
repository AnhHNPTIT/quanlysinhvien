<?php
$connection = new mysqli("172.19.0.3", "root", "root", "qlsv");
mysqli_set_charset($connection,"utf8");
if ($connection->connect_errno) {
    echo $connection->connect_errno;
} else {
   
}
