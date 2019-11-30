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

$sql2 = "INSERT INTO PESANAN VALUES (NULL,:id_user,:id_produk,NOW(),:ket,:nama,:alamat,:contak,:metode,:status,:router,:masa_waktu,:total)";
$db = $Koneksi->prepare($sql2);
$arr = array(
    ":id_user" => $_SESSION["id"],
    ":id_produk" => $_POST["id"],
    ":ket" => $_POST["Ket"],
    ":nama" => $_POST["nama"],
    ":alamat" => $_POST["alamat"],
    ":contak" => $_POST["telp"],
    ":metode" => $metode,
    ":status" => 1,
    ":router" => $_POST["router"],
    ":masa_waktu" => $_POST["waktu"],
    ":total" => $_POST["total"]
);
if ($db->execute($arr)) {
    echo "a";
} else {
    print_r($db->errorInfo());
}
