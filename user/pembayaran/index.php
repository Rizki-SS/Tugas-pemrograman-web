<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
};

if (isset($_GET["search"])) {
    $query = "SELECT ID_PEMBAYARAN, KODE_PEMESANAN, TANGGAL, BUKTI, PEMBAYARAN.STATUS, TANGGAL_UPLOAD, JUMLAH FROM PEMBAYARAN JOIN PESANAN ON KODE_PESANAN = KODE_PEMESANAN WHERE USER_ID = :id AND KODE_PEMESANAN = :cari";
    $db = $Koneksi->prepare($query);
    $data = array(
        ":cari" => $_GET["search"],
        ":id" => $_SESSION["id"]
    );
    $db->execute($data);
    $result = $db->fetchAll();
} else {
    $query = "SELECT ID_PEMBAYARAN, KODE_PEMESANAN, TANGGAL, BUKTI, PEMBAYARAN.STATUS, TANGGAL_UPLOAD, JUMLAH FROM PEMBAYARAN JOIN PESANAN ON KODE_PESANAN = KODE_PEMESANAN WHERE USER_ID = :cari";
    $db = $Koneksi->prepare($query);
    $data = array(
        ":cari" => $_SESSION["id"]
    );
    $db->execute($data);
    $result = $db->fetchAll();
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
            <br>
            <div class="row">
                <div class="col">
                    <h4>Histori Pembayaran</h4>
                </div>
                <div class="col">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Search Kode Pemesanan" aria-label="Recipient's " aria-describedby="my-addon">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text btn btn-large btn-block btn-default bg-light"><i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Kode Pemesanan</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <th scope="col">Bukti</th>
                        <th scope="col">Status</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["ID_PEMBAYARAN"] ?></th>
                            <td><?= $key["KODE_PEMESANAN"] ?></td>
                            <td><?= $key["TANGGAL"] ?></td>
                            <td><a href="<?= $key["BUKTI"] ?>" target="blank">lihat</a></td>
                            <td>
                                <?php
                                    if ($key["STATUS"] == "1") {
                                        echo "Terkonfirmasi";
                                    } else {
                                        echo "Proses";
                                    }
                                    ?>
                            </td>
                            <td><?= $key["JUMLAH"] ?></td>
                            <td>
                                <?php

                                    if ($key["STATUS"] == 1) {
                                        ?>

                                    <button disabled style="margin: 5px;" href="/user/pembayaran/upload.php?id_post=<?= $key["KODE_PEMESANAN"] ?>" type="button" class="btn btn-info">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                <?php
                                    } else {
                                        ?>
                                    <a style="margin: 5px;" href="/user/pembayaran/upload.php?id_post=<?= $key["KODE_PEMESANAN"] ?>" type="button" class="btn btn-info">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                <?php
                                    }
                                    ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

</html>