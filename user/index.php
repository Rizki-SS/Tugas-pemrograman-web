<?php
include("../header.php");
session_start();
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

header("location:/user/pembayaran")
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
                    <h4>Berlangganan</h4>
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
                        <th scope="col">#</th>
                        <th scope="col">order id</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>1</td>
                        <td>Tipe Paket : gafhsahj</td>
                        <td>
                            5 hari
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>