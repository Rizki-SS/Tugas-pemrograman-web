<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");

$sql = "UPDATE HELPDESK SET  STATUS = 1 WHERE ID = $_GET[id]";
$db = $Koneksi->prepare($sql);
if ($db->execute()) {
    header("location:index.php?Merubah Status data berhasil");
} else {
    print_r($db->errorInfo());
}
