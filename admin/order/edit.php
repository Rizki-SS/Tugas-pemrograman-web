<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

if (isset($_GET["id_post"])) {
    $query = "SELECT * FROM PESANAN INNER JOIN PRODUK ON PESANAN.ID_PRODUK = PRODUK.ID_PRODUK WHERE KODE_PESANAN = :cari";
    $db = $Koneksi->prepare($query);
    $data = array(
        ":cari" => $_GET["id_post"]
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
            include($dir . "/admin/sidebar.php");
            ?>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <form action="../order/input.php" method="POST">
                        <input type="hidden" name="id_pesanan" value="<?= $_GET["id_post"] ?>">
                        <div class="row">
                            <div class="col">
                                <h4>Order Id : <?= $_GET["id_post"] ?></h4>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#<?= $result["STATUS"] ?>').attr("selected", "selected");
                                })
                            </script>
                            <div class="col">
                                <select class="float-right" name="status" id="status">
                                    <option value="1" id="1">Active</option>
                                    <option value="2" id="2">Suspended</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <h6>Contact Detai : </h6><br>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="validationTooltip01">Name</label>
                                <input type="text" name="nama" class="form-control" value="<?= $result["NAME"] ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationTooltip02">Contact</label>
                                <input type="text" name="telp" class="form-control" value="<?= $result['contact'] ?>">
                            </div>
                        </div>
                        <label for="validationTooltip02">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?= $result['ALAMAT'] ?>">
                        <br>
                        <h6>Detail Pemesanan : </h6>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card text-center">
                                    <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                                        <h5 class="card-title"><?= $result["NAMA_PRODUK"] ?></h5>
                                        <h4 class="display-5 bg-info text-white" style="padding :15px">Rp.<?= $result["BIAYA"] ?></h4>
                                        <img src="/img/speedometer.svg" alt="" srcset="" width="30%">
                                        <h3><?= $result["SPEED"] ?></h3>
                                        <br>
                                        <?= $result["KET"] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-light">
                                    <tbody>
                                        <tr>
                                            <td>Router</td>
                                            <td>: <input type="text" class="w-50" name="router" id="router-form" value="<?= $result["router"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Masa Waktu (bulan)</td>
                                            <td>: <input class=" w-50" type="text" name="waktu" value="<?= $result["masa_waktu"] ?>" id="jangkawaktu-form">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Bulanan</td>
                                            <td>: <input type="text" class="w-75" name="bulan" id="produk-bill" value="<?= $result["BIAYA"] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Total</td>
                                            <td>: <input type="text" class=" w-75" name="total" id="total" value="<?= $result["total"] ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Metode Pembayaran Awal </td>
                                            <?php
                                            if ($result["metode"] == 1) {
                                                $b =  "Bayar saat pemasanagan";
                                            } else {
                                                $b =  "Bayar Transfer";
                                            }
                                            ?>
                                            <td>: <input type="text" name="metode" id="total" readonly style="border:none;background: #fff" value="<?= $b ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group">
                                                    <label for="my-textarea">Keterangan</label>
                                                    <textarea id="my-textarea" class="form-control" name="ket" rows="3"><?= $result["KETERANGAN"] ?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" style="margin-bottom: 2rem;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</html>