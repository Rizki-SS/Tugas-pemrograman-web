<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
session_start();

$metode;
if ($_POST['metode'] == "Bayar Transfer") {
    $metode = 1;
} else {
    $metode = 2;
};

$sql2 = "UPDATE PESANAN SET KETERANGAN = :ket, NAME = :nama, ALAMAT = :alamat, contact = :contak, STATUS = :status, router=:router, masa_waktu=:masa_waktu, total=:total WHERE KODE_PESANAN = :kode_pesanan";
$db = $Koneksi->prepare($sql2);
$arr = array(
    ":kode_pesanan" => $_POST["id_pesanan"],
    ":ket" => $_POST["Ket"],
    ":nama" => $_POST["nama"],
    ":alamat" => $_POST["alamat"],
    ":contak" => $_POST["telp"],
    ":status" => $_POST["status"],
    ":router" => $_POST["router"],
    ":masa_waktu" => $_POST["waktu"],
    ":total" => $_POST["total"]
);
if ($db->execute($arr)) {
    header("location:index.php");
} else {
    print_r($db->errorInfo());
}
