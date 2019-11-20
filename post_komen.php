<?php

include('config/database.php');


//post Komentar
if (isset($_POST["kirim"])) {
    if (isset($_POST["email"])) {
        $query = "INSERT INTO KOMENTAR VALUES (NULL,:nama,:email,:komentar,NOW(),:id)";
        $db = $Koneksi->prepare($query);
        $data = array(
            ":nama"     => $_POST["nama"],
            ":email"    => $_POST["email"],
            ":komentar" => $_POST["isi"],
            ":id"       => $_POST["id"]
        );
        if ($db->execute($data)) {
            header("location:blog.php?id=" . $_POST["id"]);
        } else {
            $msg = "Error, Post Komentar Gagal";
        }
    }
}
