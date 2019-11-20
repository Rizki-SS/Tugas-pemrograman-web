<?php
include("../header.php");
include("../config/database.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$title = "Judul";
$isi = "Text";
$id = 0;
$status = 0;

if (isset($_GET["id_post"])) {
    $query = "SELECT*FROM BLOG WHERE ID_BLOG = $_GET[id_post]";
    $db = $Koneksi->prepare($query);
    $db->execute();
    $result = $db->fetch(PDO::FETCH_ASSOC);
    $title = $result["TITLE"];
    $isi = $result["CONTEN"];
    $id = $_GET["id_post"];
    $status = $result["STATUS"];
}

?>

<div class="container">
    <h4 style="padding: 5rem 0px 0rem">Hi, <?= $_SESSION["user"] ?></h4>
    <div class="row">
        <div class="col-sm-3">
            <br>
            <?php
            include("sidebar.php");
            ?>
        </div>
        <div class="col">
            <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
            <script>
                $(document).ready(function() {
                    document.getElementById('<?= $status ?>').setAttribute("selected", "selected");
                })
            </script>
            <form method="POST" action="blog-send.php">
                <input id="title" type="text" name="title" value="<?= $title ?>"><br><br>
                <textarea id="konten" class="ckeditor" id="ckedtor" name="isi"><?= $isi ?></textarea><br>
                <label for="my-select">Simpan Sebagai : </label>
                <select name="status">
                    <option id="0" value="0">Publikasi</option>
                    <option id="1" value="1">Draf</option>
                </select>
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="submit" name="blog-send" value="blog-send">
            </form>
        </div>
    </div>
</div>
</body>

</html>