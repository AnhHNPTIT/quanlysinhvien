<?php
$connection = new mysqli("localhost", "root", "", "qlsv");
mysqli_set_charset($connection,"utf8");
if ($connection->connect_errno) {
    echo $connection->connect_errno;
} else {
}
