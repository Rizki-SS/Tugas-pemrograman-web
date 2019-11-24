<?php
$dir = $_SERVER["DOCUMENT_ROOT"];
include($dir . "/config/database.php");
$id = $_GET["id"];
$query = "DELETE FROM PRODUK WHERE ID_PRODUK=$id";
$db = $Koneksi->prepare($query);

if ($db->execute()) {
    header('location:/admin/servis/index.php?msg=delete servis id : ' . $_GET["id"] . ' sukses');
} else {
    header('location:/admin/servis/index.php?msg=delete servis id : ' . $_GET["id"] . ' gagal');
}
