<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$query = "UPDATE `WEBSITE_INFO` SET `NAME`=:name,`SLOGAN`=:slogan,`ABOUT`=:about,`PHONE`=:phone,`EMAIL`=:email,`ALAMAT`=:alamat,`HARGA_ROUTER`=:harga";
$db = $Koneksi->prepare($query);
$arry = array(
    ":name" => $_POST["name"],
    ":slogan" => $_POST["slogan"],
    ":about" => $_POST["about"],
    ":phone" => $_POST["phone"],
    ":email" => $_POST["email"],
    ":alamat" => $_POST["alamat"],
    ":harga" => $_POST["router"]
);
if ($db->execute($arry)) {
    header("location:/admin/setting/index.php?msg=Berhasil update profil");
} else {
    header("location:/admin/setting/index.php?msg=Gagal update prodil");
    // $a =print_r($db->errorInfo());
};
