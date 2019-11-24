<?php
$dir = $_SERVER["DOCUMENT_ROOT"];
include($dir . "/config/database.php");
$id = $_GET["id"];
$query = "DELETE FROM BLOG WHERE ID_BLOG=$id";
$db = $Koneksi->prepare($query);

if ($db->execute()) {
    header('location:/admin/blog/index.php?msg=delete ' . $_GET["id"] . ' sukses');
} else {
    header('location:/admin/blog/index.php?msg=delete ' . $_GET["id"] . ' gagal');
}
