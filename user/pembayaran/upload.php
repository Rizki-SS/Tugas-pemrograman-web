<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

if (isset($_GET["id_post"])) {
    $query = "SELECT ID_PEMBAYARAN,JUMLAH, BUKTI FROM PEMBAYARAN WHERE KODE_PEMESANAN = :id AND STATUS = 2 ORDER BY TANGGAL_UPLOAD DESC LIMIT 1";
    $db = $Koneksi->prepare($query);
    $data = array(
        ":id" => $_GET["id_post"]
    );
    $db->execute($data);
    $result = $db->fetch(PDO::FETCH_ASSOC);
} else {
    header("locale:index.php");
}
?>

<div class="container">
    <h4 style="padding: 5rem 0px 0rem">Hi, <?= $_SESSION["user"] ?></h4>
    <div class="row">
        <div class="col-sm-3">
            <br>
            <?php
            include($dir . "/user/sidebar.php");
            ?>
        </div>
        <div class="col">
            <?php
            $msg = $_GET["msg"];
            if (!empty($msg)) {
                ?> <div class="alert alert-success" id="msgAlert" style="display:none;">
                    <?= $msg ?>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#msgAlert").slideDown();
                        $("#msgAlert").delay(3000);
                        $("#msgAlert").slideUp();
                    });
                </script>
            <?php
            }
            ?>
            <div class="col">
                <h4>Pembayaran - Order Id : <?= $_GET["id_post"] ?></h4>
            </div>

            <hr>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <form method="POST" action="/user/pembayaran/input.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="my-input">Jumlah</label>
                            <input id="my-input" class="form-control" type="text" name="jumlah" value="<?= $result["JUMLAH"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="my-input">Upload/Perbarui Bukti Pembayaran</label>
                            <input id="my-input" class="form-control" type="file" name="foto" accept=".jpg, .png, .jpeg|image/*">
                            <input type="hidden" name="id_post" value="<?= $_GET["id_post"] ?>">
                            <?php
                            if ($result["ID_PEMBAYARAN"] != null) {
                                echo '<input type="hidden" name="id_pembayaran" value="' . $result["ID_PEMBAYARAN"] . '">';
                            } else {

                                echo '<input type="hidden" name="id_pembayaran"';
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-7">
                    <?php
                    if (isset($result["ID_PEMBAYARAN"])) {
                        echo "<img src=" . $result["BUKTI"] . " class=img-thumbnail>";
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>


</html>