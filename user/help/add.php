<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");

$sql = "INSERT INTO HELPDESK VALUES (NULL,:id_member,:kode_pesanan,:keterangan,:status)";
$db = $Koneksi->prepare($sql);
$data = array(
    ":id_member" => $_SESSION["id"],
    ":kode_pesanan" => $_GET["kode_pesanan"],
    ":keterangan" => $_GET["ket"],
    ":status" => 0
);
if ($db->execute($data)) {
    header("location:index.php");
} else {
    print_r($db->errorInfo());
}