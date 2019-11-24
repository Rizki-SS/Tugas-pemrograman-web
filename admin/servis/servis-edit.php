<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}
$result;

$query = "SELECT*FROM TIPE_PRODUK";
$db = $Koneksi->prepare($query);
$db->execute();
$result_tipe = $db->fetchAll();
$n = 0;
if (isset($_GET["id_post"])) {
    $query = "SELECT*FROM PRODUK AS P JOIN TIPE_PRODUK AS TP ON P.ID_TIPE=TP.ID_TIPE WHERE P.ID_PRODUK = $_GET[id_post]";
    $db = $Koneksi->prepare($query);
    $db->execute();
    $result = $db->fetch(PDO::FETCH_ASSOC);
    $n = $result["ID_PRODUK"];
}


?>

<div class="container">
    <h4 style="padding: 5rem 0px 0rem">Hi, <?= $_SESSION["user"] ?></h4>
    <div class="row">
        <div class="col-sm-3">
            <br>
            <?php
            include($dir . "/admin/sidebar.php");
            ?>
        </div>
        <div class="col">
            <script type="text/javascript" src="/admin/ckeditor/ckeditor.js"></script>
            <script>
                $(document).ready(function() {
                    document.getElementById('<?= $result["ID_TIPE"] ?>').setAttribute("selected", "selected");
                })
            </script>
            <h5>
                <?php
                if (isset($_GET["id_post"])) {
                    echo 'Edit Blog id : ' . $result["ID_PRODUK"];
                } else {
                    echo 'Add New Blog';
                }
                ?>
            </h5>
            <hr>
            <form method="POST" action="servis-send.php">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kategori :</label>
                    <div class="col-sm-10">
                        <select name="kategori" id="kat">
                            <?php
                            foreach ($result_tipe as $key) {
                                ?>
                                <option id="<?= $key["ID_TIPE"] ?>" value="<?= $key["ID_TIPE"] ?>"><?= $key["NAMA_TIPE"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" id="text" placeholder="nama produk" value="<?= $result["NAMA_PRODUK"] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Biaya</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="biaya" id="text" placeholder="nama produk" value="<?= $result["BIAYA"] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Speed</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="Speed" id="text" placeholder="/Mps" value="<?= $result["SPEED"] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="ckeditor" id="ckedtor" name="isi"><?= $result["KET"] ?></textarea><br>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-sm-3 col-form-label">Tampilkan Di Halaman Depan</label>
                    <div class="form-check">
                        <?php
                        if ($result["RECOMENDED"] == 1) {
                            ?>
                            <input id="my-input" class="form-check-input" checked type="checkbox" name="recomended" value="1">
                            <label for="my-input" class="form-check-label">Ya</label>
                        <?php
                        } else {
                            ?>
                            <input id=" my-input" class="form-check-input" type="checkbox" name="recomended" value="1">
                            <label for="my-input" class="form-check-label">Ya</label>
                        <?php
                        };
                        ?>

                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $n ?>">
                <button type=" submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>

</html>