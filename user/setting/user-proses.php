<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");

if (isset($_POST["simpan"])) {

    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $query = "UPDATE MEMBER SET USERNAME=:user,EMAIL=:email,ALAMAT=:alamat WHERE USER_ID = :id";
    $db = $Koneksi->prepare($query);
    $arry = array(
        ":user" => $username,
        ":email" => $email,
        ":alamat" => $_POST["alamat"],
        ":id" => $_POST["id"]
    );
    if ($db->execute($arry)) {
        header("location:/user/setting/index.php?msg=Berhasil update profil");
    } else {
        header("location:/user/setting/index.php?msg=Gagal update prodil");
    };
} else {
    $query = "SELECT PASSWORD FROM MEMBER WHERE USER_ID = $_SESSION[id]";
    $db = $Koneksi->prepare($query);
    $db->execute();
    $result = $db->fetch(PDO::FETCH_ASSOC);
    if ($_POST["OldPassword"] == $result["PASSWORD"]) {
        $query = "UPDATE MEMBER SET PASSWORD=:password WHERE USER_ID = :id";
        $db = $Koneksi->prepare($query);
        $arry = array(
            ":password" => $_POST["newPassword"],
            ":id" => $_POST["id"]
        );
        if ($db->execute($arry)) {
            header("location:../user/setting/index.php?msg=Berhasil update password");
        } else {
            header("location:../user/setting/index.php?msg=Gagal update profil");
        }
    } else {
        header("location:../user/setting/index.php?msg=Password lama anda salah");
    }
}
