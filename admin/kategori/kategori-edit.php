<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$msg = "";

if (isset($_GET["kategori_name"])) {
    if (isset($_GET["id"])) {
        # update
        $sql = "UPDATE TIPE_PRODUK SET NAMA_TIPE=:nama WHERE ID_TIPE=$_GET[id]";
        $db = $Koneksi->prepare($sql);
        $arr = array(
            ":nama" => $_GET['kategori_name']
        );
        $db->execute($arr);
        $msg = "Update kategori sukses";
    } else {
        # input new
        $sql = "INSERT INTO TIPE_PRODUK (ID_TIPE, NAMA_TIPE) VALUE (null,:nama)";
        $db = $Koneksi->prepare($sql);
        $arr = array(
            ":nama" => $_GET['kategori_name']
        );
        $db->execute($arr);
        $msg = "input new kategori sukses";
    }
} else {
    # delete
    $sql = "DELETE FROM TIPE_PRODUK WHERE ID_TIPE=$_GET[id]";
    $db = $Koneksi->prepare($sql);
    $db->execute();
    $msg = "deletes data sukses";
}

if (!($msg == "")) {
    header("location:/admin/kategori/index.php?msg=" . $msg);
} else {
    header("location:/admin/keategori/index.php?msg=gagal");
}
