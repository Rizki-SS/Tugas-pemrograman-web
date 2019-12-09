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

$querydata = "SELECT * FROM WEBSITE_INFO";
$db = $Koneksi->prepare($querydata);
$db->execute();
$dataweb = $db->fetch(PDO::FETCH_ASSOC);
