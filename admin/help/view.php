<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");

session_start();

if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$sql = "SELECT * FROM HELPDESK WHERE ID = :id";
$db = $Koneksi->prepare($sql);
$data = array(
    ":id" => $_POST["id"]
);
$db->execute($data);
$result = $db->fetch(PDO::FETCH_ASSOC);

?>

<div class="form-group">
    <label for="my-input">Kode Pesanan : </label>
    <select disabled name="kode_pesanan" id="my-input">
        <option selected><?= $result["ID_PESANAN"] ?></option>
    </select>
</div>
<div class=" form-group">
    <label for="my-input">Judul</label>
    <input readonly id="my-input" class="form-control" type="text" name="judul" value="<?= $result["JUDUL"] ?>">
</div>
<div class=" form-group">
    <label for="my-input">Keterangan</label>
    <textarea readonly id="my-input" class="form-control" name="ket" cols="30" rows="5"><?= $result["KETERANGAN"] ?></textarea>
</div>
<div class=" form-group">
    <label for="my-input">Answer</label>
    <textarea id="my-input" class="form-control" cols="30" rows="5" name="answer"><?= $result["ANSWER"] ?></textarea>
</div>
<input type="hidden" name="id" value="<?= $_POST['id'] ?>">