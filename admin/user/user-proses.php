<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");

$query = "UPDATE MEMBER SET USERNAME=:user,EMAIL=:email,ALAMAT=:alamat, TIPE_USER=:status WHERE USER_ID = :id";
$db = $Koneksi->prepare($query);
$arry = array(
    ":user" => $_POST["user"],
    ":email" => $_POST["email"],
    ":alamat" => $_POST["alamat"],
    ":id" => $_POST["id"],
    ":status" => $_POST["status"]
);
if ($db->execute($arry)) {
    header("location:../user");
} else {
    echo 'asdsad';
}
