<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

if (isset($_GET["search"])) {
    $query = "SELECT * FROM ORDER_ADMIN WHERE KODE_PESANAN = :cari";
    $db = $Koneksi->prepare($query);
    $data = array(
        ":cari" => $_GET["search"]
    );
    $db->execute($data);
    $result = $db->fetchAll();
} else {
    $query = "SELECT*FROM ORDER_ADMIN WHERE USER_ID = $_SESSION[id]";
    $db = $Koneksi->prepare($query);
    $db->execute();
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
                    <h4>Order-List</h4>
                </div>
                <div class="col">
                    <form method="GET">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" placeholder="Search Servis Id" aria-label="Recipient's " aria-describedby="my-addon">
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
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Biaya Bulanan</th>
                        <th scope="col">Jangka Waktu</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["KODE_PESANAN"] ?></th>
                            <td><?= $key["NAMA_PRODUK"] ?></td>
                            <td><?= $key["BIAYA"] ?></td>
                            <td>
                                <?= $key["masa_waktu"] ?> Bulan
                            </td>
                            <td>
                                <?php
                                    $status = false;
                                    if ($key["STATUS"] == "1") {
                                        if ($key["TANGGAL"] != null) {
                                            $add = '+' . $key["masa_waktu"] . ' month';
                                            $datenow = new DateTime('now');
                                            $dateend = new DateTime($key["TANGGAL"]);
                                            $dateend->modify($add);
                                            if ($dateend > $datenow) {
                                                $timeleft = $dateend->diff($datenow);
                                                echo $timeleft->format("%a days left");
                                                echo "<small><br>Until : " . $dateend->format("d - M - Y") . "</small>";
                                                $status = true;
                                            } else {
                                                echo "Belum Membayar/Terkonfirmasi";
                                            }
                                        } else {
                                            echo "Belum Membayar/Terkonfirmasi";
                                        }
                                    } else {
                                        echo "Suspended";
                                    }
                                    ?>
                            </td>
                            <td>
                                <div class="row">
                                    <?php
                                        if ($status) {
                                            ?>
                                        <button style="margin: 5px;" disabled href="/admin/pembayaran/upload.php?id_post=<?= $key["KODE_PESANAN"] ?>" type="button" class="btn btn-info">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                    <?php
                                        } else {
                                            ?>
                                        <a style="margin: 5px;" href="/user/pembayaran/upload.php?id_post=<?= $key["KODE_PESANAN"] ?>" type="button" class="btn btn-info">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    <?php
                                        }
                                        ?>
                                </div>
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