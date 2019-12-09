<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

if (isset($_GET["search"])) {
    $query = "SELECT * FROM PEMBAYARAN WHERE KODE_PEMESANAN = :cari";
    $db = $Koneksi->prepare($query);
    $data = array(
        ":cari" => $_GET["search"]
    );
    $db->execute($data);
    $result = $db->fetchAll();
} else {
    $query = "SELECT*FROM PEMBAYARAN ORDER BY ID_PEMBAYARAN DESC";
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
            include($dir . "/admin/sidebar.php");
            ?>
        </div>
        <div class="col">
            <br>
            <div class="row">
                <div class="col">
                    <h4>Order-List</h4>
                </div>
                <div class="col">
                    <form action="index.php" method="GET">
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
                                    <button disabled style="margin: 5px;" data-id="<?= $key["ID_PEMBAYARAN"] ?>" type="button" class="btn btn-info konfirm" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    </button>
                                <?php
                                    } else {
                                        ?>
                                    <button style="margin: 5px;" data-id="<?= $key["ID_PEMBAYARAN"] ?>" type="button" class="btn btn-info konfirm" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    </button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/pembayaran/konfirm.php" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Konfirmasi Pembayaran Untuk Id pembayaran

                    <input type="text" name="id_post" id="id" readonly>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                    <input type="submit" class="btn btn-info" value="YA">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $('.konfirm').click(function() {
            var ID = $(this).data('id');
            $("#id").val(ID);
        });
    });
</script>

</html>