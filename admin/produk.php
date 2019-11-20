<?php
include("../header.php");
include("../config/database.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$query = "SELECT*FROM PRODUK AS P JOIN TIPE_PRODUK AS TP ON P.ID_TIPE=TP.ID_TIPE";
$db = $Koneksi->prepare($query);
$db->execute();
$result = $db->fetchAll();
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
            <br>
            <div class="row">
                <div class="col">
                    <h4>User</h4>
                    <form method="POST" action="">
                </div>
                <div class="col">
                    <form method="POST" action="">
                        <div class="input-group">
                            <input class="form-control" type="text" name="" placeholder="Recipient's text" aria-label="Recipient's " aria-describedby="my-addon">
                            <div class="input-group-append">
                                <button type="button" class="input-group-text btn btn-large btn-block btn-default bg-light">button</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Speed</th>
                        <th scope="col">Ket</th>
                        <th scope="col">DIskon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["ID_PRODUK"] ?></th>
                            <td><?= $key["NAMA_TIPE"] ?></td>
                            <td><?= $key["NAMA_PRODUK"] ?></td>
                            <td><?= $key["BIAYA"] ?></td>
                            <td><?= $key["SPEED"] ?></td>
                            <td><?= $key["KET"] ?></td>
                            <td><?= $key["DISKON"] ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-block btn-info">button</button>
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
</body>

</html>