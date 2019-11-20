<?php
include('header.php');
include("config/database.php");
session_start();

$queri = "SELECT * FROM PRODUK WHERE RECOMENDED=1";
$db1 = $Koneksi->prepare($queri);
$db1->execute();
$result_produk = $db1->fetchAll();


?>

<div class="container-fluid" id="cover">
    <div class="container">
        <div class="col" style="padding : 15rem 0 12rem">
            <h1 class="text-white display-4">I_NET</h1>
            <h5 class="text-white">Profesional sloution for<br> home and company network service</h5>
        </div>
    </div>
</div>
<div class="container conten">

    <h2 class="display-6 text-center" style="margin  :50px">Why We Are ?</h2>

    <div class="row text-center">

        <div class="col-lg-3">
            <div class="card border-0">
                <img src="img/icon 1-Peforma Jaringan Yang Stabil.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Jaringan Yang Stabi</h5>
                    <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus
                        voluptatum sequi accusamus animi minima molestiae, itaque a atque maiores qui rerum
                        sed,
                        eveniet culpa, est illo quos ipsum. Veritatis, sed.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0">
                <img src="img/icon 1-Layanan Terbaik.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Layanan Terbaik</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae nemo
                        mollitia harum repellendus libero? Aliquid nesciunt, ratione excepturi architecto
                        similique
                        amet quis nemo quae dicta saepe ex ullam molestias quos!</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0">
                <img src="img/icon 1-konten yang menarik.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Konten Yang Menarik</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit ea
                        beatae
                        quae ullam, possimus, maxime, temporibus enim iusto velit in aperiam! Voluptatum optio
                        accusantium exercitationem rerum placeat porro quod dignissimos!</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border-0">
                <img src="img/icon 1-Terbaik.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Teknisi Terbaik</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore
                        repellendus et quos facilis dolor voluptatem nostrum voluptates! Repellat ad in esse
                        similique, inventore alias, quam quod quia dolorem, autem aliquid.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" id="tex" style="padding:20px 0">
    <div class="container text-center text-white" style="padding :50px 0px">
        <h2 class="display-6 text-center">We Are Technologi</h2>
        <h4 class="text-center">#Fiber-Optic</h4>
        <br>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt minima ab consequuntur eligendi,
            rerum ex exercitationem pariatur earum quis asperiores aut tempore consectetur accusamus
            praesentium
            laudantium nesciunt quam molestias? Expedita! Lorem ipsum dolor sit amet consectetur adipisicing
            elit.
            Magnam debitis tenetur nisi. Sapiente commodi officiis nostrum, odit temporibus voluptate eligendi
            consequatur ipsum placeat maiores enim similique, sunt laudantium ullam animi!</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deserunt minima ab consequuntur eligendi,
            rerum ex exercitationem pariatur earum quis asperiores aut tempore consectetur accusamus
            praesentium
            laudantium nesciunt quam molestias? Expedita!</p>
        <a class="btn btn-sm btn-default bg-light rounded-pill" href="#">Lebih Lanjut</a>
    </div>
</div>
<div class="container">

    <h2 class="display-6 text-center" style="margin  :50px">Recomended Product</h2>

    <div class="row text-center">
        <?php foreach ($result_produk as $key1) {
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
                        <a class="btn btn-sm btn-default bg-info rounded-pill" href="#">Install Now</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- <div class="col-sm-4">
            <div class="card">
                <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                    <h5 class="card-title">Paket Home Net 1</h5>
                    <h4 class="display-5 bg-info text-white" style="padding :15px">Rp.000000</h4>
                    <img src="img/speedometer.svg" alt="" srcset="" width="30%">
                    <h3>5 MB/s</h3>
                    <br>
                    <li>Free 1 Wired Router</li>
                    <li>Free Installasi</li>
                    <li>Dynamic Ip</li>
                    <li>Recomended For 5-10 PC/Gadget</li>
                    <br>
                    <br>
                    <a class="btn btn-sm btn-default bg-info rounded-pill" href="#">Install Now</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                    <h5 class="card-title">Paket Home Net 1</h5>
                    <h4 class="display-5 bg-info text-white" style="padding :15px">Rp.000000</h4>
                    <img src="img/speedometer.svg" alt="" srcset="" width="30%">
                    <h3>5 MB/s</h3>
                    <br>
                    <li>Free 1 Wired Router</li>
                    <li>Free Installasi</li>
                    <li>Dynamic Ip</li>
                    <li>Recomended For 5-10 PC/Gadget</li>
                    <br>
                    <br>
                    <a class="btn btn-sm btn-default bg-info rounded-pill" href="#">Install Now</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                    <h5 class="card-title">Paket Home Net 1</h5>
                    <h4 class="display-5 bg-info text-white" style="padding :15px">Rp.000000</h4>
                    <img src="img/speedometer.svg" alt="" srcset="" width="30%">
                    <h3>5 MB/s</h3>
                    <br>
                    <li>Free 1 Wired Router</li>
                    <li>Free Installasi</li>
                    <li>Dynamic Ip</li>
                    <li>Recomended For 5-10 PC/Gadget</li>
                    <br>
                    <br>
                    <a class="btn btn-sm btn-default bg-info rounded-pill" href="#">Install Now</a>
                </div>
            </div>
        </div> -->
        <div class="row w-100">

            <button type="button" style="margin :20px auto" class="btn btn-large btn-block btn-default">button</button>

        </div>
    </div>
</div>
<div class="container-fluid" id="contact" style="margin:30px 0px">
    <div class="container" style="padding:20px">
        <div class="row bg-light rounded w-100 " style="padding:10px ">
            <h1 class="display-4 text-center m-auto">Contact Us : +666 666 777</h1>
        </div>
    </div>
</div>
<div class="container">
    <h2 class="display-6 text-center" style="margin  :50px">Blog</h2>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lorem</h5>
                    <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste earum
                        consectetur repellat pariatur dolorum deserunt dicta saepe error. Non cupiditate, sit ea
                        magnam asperiores corrupti veritatis soluta cumque? In, reprehenderit!</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lorem ipsum dolor sit</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, expedita
                        rem, fuga illum placeat labore enim totam nostrum voluptatibus error cumque tenetur
                        repellat consequuntur deserunt reprehenderit dolorum, consectetur quis? Dolore?</p>
                </div>
            </div>
        </div>
    </div>
</div>
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
                        <li><a href="product.php">Produk</a></li>
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