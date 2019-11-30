<?php

session_start();
include("config/database.php");

$queri = "SELECT * FROM TIPE_PRODUK";
$db = $Koneksi->prepare($queri);
$db->execute();
$result_tipe = $db->fetchAll();

$queri = "SELECT * FROM PRODUK";
$db1 = $Koneksi->prepare($queri);
$db1->execute();
$result_produk = $db1->fetchAll();

include('header.php')
?>
<div class="container" style="padding-top:20px">

    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                <?php foreach ($result_tipe as $key) {
                    ?>
                    <a class="nav-link" id="v-pills-<?= $key['ID_TIPE'] ?>-tab" data-toggle="pill" href="#v-pills-<?= $key['ID_TIPE'] ?>" role="tab" aria-controls="v-pills-<?= $key['ID_TIPE'] ?>" aria-selected="false"><?= $key["NAMA_TIPE"] ?></a>
                <?php
                } ?>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="row text-center">
                        <?php
                        foreach ($result_produk as $key1) {
                            ?>
                            <div class="col-sm-4">
                                <div class="card" style="margin-bottom: 2rem;">
                                    <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                                        <h5 class="card-title"><?= $key1["NAMA_PRODUK"] ?></h5>
                                        <h4 class="display-5 bg-info text-white" style="padding :15px">Rp.<?= $key1["BIAYA"] ?></h4>
                                        <img src="img/speedometer.svg" alt="" srcset="" width="30%">
                                        <h3><?= $key1["SPEED"] ?></h3>
                                        <br>
                                        <?= $key1["KET"] ?>
                                        <br>
                                        <br>
                                        <a class="btn btn-sm btn-default bg-info rounded-pill" href="../order/index.php?idproduk=<?= $key1["ID_PRODUK"] ?>">Install Now</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                </div>
                <?php
                foreach ($result_tipe as $key) {
                    ?>
                    <div class="tab-pane fade" id="v-pills-<?= $key['ID_TIPE'] ?>" role="tabpanel" aria-labelledby="v-pills-<?= $key['ID_TIPE'] ?>-tab">
                        <div class="row text-center">
                            <?php
                                foreach ($result_produk as $key1) {
                                    if ($key["ID_TIPE"] == $key1["ID_TIPE"]) {
                                        ?>
                                    <div class="col-sm-4">
                                        <div class="card">
                                            <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                                                <h5 class="card-title"><?= $key1["NAMA_PRODUK"] ?></h5>
                                                <h4 class="display-5 bg-info text-white" style="padding :15px">Rp.<?= $key1["BIAYA"] ?></h4>
                                                <img src="img/speedometer.svg" alt="" srcset="" width="30%">
                                                <h3><?= $key1["SPEED"] ?></h3>
                                                <br>
                                                <?= $key1["KET"] ?>
                                                <br>
                                                <br>
                                                <a class="btn btn-sm btn-default bg-info rounded-pill" href="../order/index.php?idproduk=<?= $key1["ID_PRODUK"] ?>">Install Now</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    }
                                }
                                ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- footer -->

<div class="container-fluid" style="margin:30px 0px">
    <hr>
    <div class="container" style="padding:10px">
        <div class="row">
            <div class="col-sm-6">

                <div class="row">
                    <a href="" style="padding-right: 10px"><img src="img/icon sosmed 1.png" alt="" srcset="">Facebook</a>
                    <a href="" style="padding-right: 10px"><img src="img/icon sosmed 2.png" alt="" srcset="">Twitter</a>
                    <a href="" style="padding-right: 10px"><img src="img/icon sosmed 3.png" alt="" srcset="">Intagramm</a>
                </div>

            </div>
            <div class="col-sm-6">
                <form method="post">
                    <div class="input-group">
                        <input class="form-control" type="text" name="" placeholder="Subcribe to get more promo" aria-label="Recipient's " aria-describedby="my-addon">
                        <div class="input-group-append">
                            <span class="input-group-text" id="my-addon">Text</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3966.5094506570094!2d106.79888596271853!3d-6.196312836710421!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f69442dcbd7b%3A0xcf289699bcf2da38!2sPolres%20Metro%20Jakarta%20Barat!5e0!3m2!1sid!2sid!4v1571634378794!5m2!1sid!2sid" width="470" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <blockquote class="blockquote">
                    <p class="mb-0">About :</p>
                    <footer class="blockquote-footer">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Incidunt ea dolore, minus laborum, laboriosam sit provident deleniti cumque, aut tempora
                        libero qui molestiae temporibus eveniet autem soluta inventore recusandae et.
                        <a href="#">more ...</a>
                    </footer>
                </blockquote>
            </div>
            <div class="row">
                <div class="col">
                    <p class="mb-0">Active Link</p>
                    <ul class="list-unstyled">
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Produk</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col">
                    <p class="mb-0">Contact :</p>
                    <ul class="list-unstyled">
                        <li>Phone : </li>
                        <li>Email : </li>
                        <li>Alamat :</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card" style="margin-top :10px">
    <div class="panel panel-default">
        <div class="panel-footer text-center">
            Panel footer
        </div>
    </div>

</div>

</body>

</html>