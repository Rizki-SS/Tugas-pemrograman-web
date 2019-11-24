
<?php

$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
session_start();

if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

if (!(($_POST["id"] == 0))) {
    $query = "UPDATE PRODUK SET ID_TIPE=:ID_TIPE,NAMA_PRODUK=:NAMA_PRODUK,BIAYA=:BIAYA, SPEED=:SPEED, KET=:KET, RECOMENDED=:RECOMENDED WHERE ID_PRODUK = $_POST[id]";
    $db = $Koneksi->prepare($query);

    $arry = array(
        ":ID_TIPE" => $_POST["kategori"],
        ":NAMA_PRODUK" => $_POST["nama"],
        ":BIAYA" => $_POST["biaya"],
        ":SPEED" => $_POST["Speed"],
        ":KET" => $_POST["isi"],
        ":RECOMENDED" => $_POST["recomended"]
    );

    if ($db->execute($arry)) {
        header("location:/admin/servis/");
    }
} else {
    $query = "INSERT INTO PRODUK (ID_PRODUK, ID_TIPE, NAMA_PRODUK, BIAYA, SPEED, KET, RECOMENDED) VALUE (NULL,:ID_TIPE,:NAMA_PRODUK,:BIAYA,:SPEED,:KET,:RECOMENDED)";
    $db = $Koneksi->prepare($query);
    $arry = array(
        ":ID_TIPE" => $_POST["kategori"],
        ":NAMA_PRODUK" => $_POST["nama"],
        ":BIAYA" => $_POST["biaya"],
        ":SPEED" => $_POST["Speed"],
        ":KET" => $_POST["isi"],
        ":RECOMENDED" => $_POST["recomended"]
    );
    if ($db->execute($arry)) {
        header("location:/admin/servis/");
    }
}
