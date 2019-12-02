<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
session_start();

$id = $_POST["id_post"];

$temp = explode(".", $_FILES["foto"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$extension  = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
$newfilename = $newfilename . '.' . $extension;

$target_path = $dir . "/img/pembayaran/";

$target_path = $target_path . $newfilename;

$type = $_FILES['foto']['type'];
$size = $_FILES['foto']['size'];

if ($size < 2097152) {
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_path)) {
        if ($_POST["id_pembayaran"] == "") {
            $query = "INSERT INTO PEMBAYARAN VALUE(NULL,:id,NOW(),:bukti,2,NOW(),:jumlah)";
            $db = $Koneksi->prepare($query);
            $data = array(
                ":id" => $_POST["id_post"],
                ":bukti" => "/img/pembayaran/" . $newfilename,
                ":jumlah" => $_POST["jumlah"]
            );
            $db->execute($data);
        } else {
            $query = "UPDATE PEMBAYARAN SET SET STATUS=2, BUKTI=:bukti TANGGAL_UPLOAD=NOW(),JUMLAH=:jumlah WHERE ID_PEMBAYARAN = :ID_PEMBAYARAN";
            $db = $Koneksi->prepare($query);
            $data = array(
                ":bukti" => "/img/pembayaran/" . $newfilename,
                ":jumlah" => $_POST["jumlah"]
            );
            $db->execute($data);
        }
        print_r($db->errorInfo());
        header("location:/user/pembayaran/upload.php?msg='Upload Sukses&id_post=" . $id . "");
    } else if (isset($_POST["id_pembayaran"])) {
        $query = "UPDATE PEMBAYARAN SET STATUS=2, TANGGAL_UPLOAD=NOW(),JUMLAH=:jumlah WHERE ID_PEMBAYARAN = :ID_PEMBAYARAN";
        $db = $Koneksi->prepare($query);
        $data = array(
            ":jumlah" => $_POST["jumlah"],
            ":ID_PEMBAYARAN" => $_POST["id_pembayaran"]
        );
        $db->execute($data);
        print_r($db->errorInfo());
        header("location:/user/pembayaran/upload.php?msg='Update_Sukses&id_post=" . $id . "");
    } else {
        header("location:/user/pembayaran/upload.php?msg='Upload Error'");
    };
} else {
    header("location:/user/pembayaran/upload.php?msg='Ukuran tidak boleh lebih dari 2 MB'");
    # code...
}
