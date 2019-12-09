<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");

$sql = "INSERT INTO HELPDESK VALUES (NULL,:id_member,:kode_pesanan,:judul,:keterangan,:status,NULL)";
$db = $Koneksi->prepare($sql);
$data = array(
    ":id_member" => $_SESSION["id"],
    ":kode_pesanan" => $_GET["kode_pesanan"],
    ":judul" => $_GET["judul"],
    ":keterangan" => $_GET["ket"],
    ":status" => 0
);
if ($db->execute($data)) {
    header("location:index.php?msg=bantuan telah terkirim, silahkan tunggu untuk mendapatkan balasan");
} else {
    print_r($db->errorInfo());
}
