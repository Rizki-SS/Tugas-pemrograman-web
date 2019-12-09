<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");

$query = "UPDATE PEMBAYARAN SET TANGGAL = NOW(), STATUS=1 WHERE ID_PEMBAYARAN = :id";
$db = $Koneksi->prepare($query);
$data = array(
    ":id" => $_GET['id_post']
);
if ($db->execute($data)) {
    header("location:index.php?msg=Konfirmasi Berhasil");
} else {
    print_r($db->errorInfo());
}
