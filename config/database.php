<?php

$host_name = "localhost";
$db_name = "inet";
$username = "isak";
$password = "qwertyuiop";


$Koneksi = new PDO(
    "mysql:host=$host_name;
                    dbname=$db_name",
    $username,
    $password
);

if ($Koneksi) {
    // echo 'adadd';
}
