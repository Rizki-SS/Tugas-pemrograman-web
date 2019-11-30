<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");

session_start();
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$queri = "SELECT * FROM PRODUK WHERE ID_PRODUK=$_POST[id]";
$db = $Koneksi->prepare($queri);
$db->execute();
$result_produk = $db->fetch(PDO::FETCH_ASSOC);

?>


<div class="card-body" id="produk-view">
    <h5 class="card-title"><?= $result_produk["NAMA_PRODUK"] ?></h5>
    <small>Harga :<input type="text" name="total" class="harga_paket" readonly style="border:none;background: #fff" value="<?= $result_produk["BIAYA"] ?>"></small>
    <p class="card-text"><?= $result_produk["SPEED"] ?></p>
</div>