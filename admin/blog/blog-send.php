
<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

if (!($_POST["id"] == 0)) {
    $query = "UPDATE BLOG SET TITLE=:title,DATE=NOW(),CONTEN=:isi,STATUS=:status WHERE ID_BLOG = :id";
    $db = $Koneksi->prepare($query);
    $arry = array(
        ":title" => $_POST["title"],
        ":isi" => $_POST["isi"],
        ":status" => $_POST["status"],
        ":id" => $_POST["id"]
    );
    if ($db->execute($arry)) {
        header("location:/admin/blog");
    }
} else {
    $query = "INSERT INTO BLOG VALUES (NULL, :title, NOW(), :isi, :status)";
    $db = $Koneksi->prepare($query);
    $arry = array(
        ":title" => $_POST["title"],
        ":isi" => $_POST["isi"],
        ":status" => $_POST["status"]
    );
    $a = $db->execute($arry);
    if ($a) {
        header("location:/admin/blog");
    }
}
