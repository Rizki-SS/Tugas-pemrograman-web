<?php
include('header.php');
include("config/database.php");

$queri = "SELECT * FROM PRODUK WHERE RECOMENDED=1";
$db1 = $Koneksi->prepare($queri);
$db1->execute();
$result_produk = $db1->fetchAll();


?>

<div class="container-fluid" id="cover">
    <div class="container">
        <div class="col" style="padding : 15rem 0 12rem">
            <h1 class="text-white display-4"><?= $dataweb["NAME"] ?></h1>
            <h4 class="text-white"><?= $dataweb["SLOGAN"] ?></h4>
        </div>
    </div>
</div>
<div class="container conten">

    <h2 class="display-6 text-center" style="margin  :50px">Why We Are ?</h2>

    <div class="row text-center">

        <div class="col-md-3">
            <div class="card border-0">
                <img src="img/icon 1-Peforma Jaringan Yang Stabil.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Jaringan Yang Stabi</h5>
                    <p class="card-text">menyediakan layanan jaringan telekomunikasi dan multimedia yang lengkap untuk memenuhi kebutuhan pelanggan bisnis dan konsumen dengan harga yang terjangkau.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0">
                <img src="img/icon 1-Layanan Terbaik.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Layanan Terbaik</h5>
                    <p class="card-text">Customer Care dan Network Operation Center selalu tersedia 24 x 7 x 365, Anda dapat menghubungi kami melalui telepon, email atau chat.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0">
                <img src="img/icon 1-konten yang menarik.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Konten Yang Menarik</h5>
                    <p class="card-text">terkoneksi secara langsung ke beberapa Provider Tier-1 dan Internet Exchange terkemuka di dunia, sehingga memiliki rute yang singkat ke jaringan yang dituju. </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0">
                <img src="img/icon 1-Terbaik.png" alt="" srcset="" width="50%" style="margin:10px auto">
                <div class="card-body">
                    <h5 class="card-title">Teknisi Terbaik</h5>
                    <p class="card-text">Tim Teknisi terbaik, yang sebagian besar merupakan memiliki sertifikat keahlian yang terpercaya dan berpengalaman</p>
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
        <p>Serat optik adalah saluran transmisi atau sejenis kabel yang terbuat dari kaca atau plastik yang sangat halus dan lebih kecil dari sehelai rambut, dan dapat digunakan untuk mentransmisikan sinyal cahaya dari suatu tempat ke tempat lain. Sumber cahaya yang digunakan biasanya adalah laser atau LED[1]. Kabel ini berdiameter kurang lebih 120 mikrometer.
        </p>
        <p>
            Cahaya yang ada di dalam serat optik tidak keluar karena indeks bias dari kaca lebih besar daripada indeks bias dari udara, karena laser mempunyai spektrum yang sangat sempit. Kecepatan transmisi serat optik sangat tinggi sehingga sangat bagus digunakan sebagai saluran komunikasi. </p>
        <a class="btn btn-sm btn-default bg-light rounded-pill" href="/blog.php?id=9">Lebih Lanjut</a>
    </div>
</div>

<div class="container">

    <h2 class="display-6 text-center" style="margin  : 50px 0px 20px">Recomended Product</h2>

    <div class="row text-center">
        <?php foreach ($result_produk as $key1) {
            ?>
            <div class="col-md-4" style="margin:10px 0px;">
                <div class="card">
                    <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                        <h5 class="card-title"><?= $key1["NAMA_PRODUK"] ?></h5>
                        <h4 class="display-5 bg-primary text-white" style="padding :15px">Rp.<?= $key1["BIAYA"] ?></h4>
                        <img src="img/speedometer.svg" alt="" srcset="" width="30%">
                        <h3><?= $key1["SPEED"] ?></h3>
                        <br>
                        <?= $key1["KET"] ?>
                        <br>
                        <br>
                        <a class="btn btn-sm btn-default bg-primary rounded-pill text-white" href="#">Install Now</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="row w-100">
            <a href="/product.php" type="button" style="margin :20px;" class="btn btn-small bg-primary rounded-pill text-white">See More</a>
        </div>
    </div>
</div>
<div class="container-fluid" id="contact" style="margin:30px 0px">
    <div class="container" style="padding:20px">
        <div class="row bg-light rounded" style="padding:10px ">
            <h3 class="text-center m-auto">Contact Us : <?= $dataweb["PHONE"] ?></h3>
        </div>
    </div style="font-family : sans-serif">
</div>
<?php
$query = "SELECT*FROM BLOG WHERE STATUS = 0 ORDER BY DATE DESC LIMIT 2";
$db = $Koneksi->prepare($query);
$db->execute();
$result_blog = $db->fetchAll();
?>
<div class="container">
    <h2 class="display-6 text-center" style="margin  :50px">Blog</h2>
    <div class="row">
        <?php
        foreach ($result_blog as $key) {
            ?>
            <div class="col-sm-6">
                <div class="card blog-news" style="font-size: 14px !important">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/blog.php?id=<?= $key['ID_BLOG'] ?>"><?= $key['TITLE'] ?></a>
                        </h5>
                        <p><?= substr($key['CONTEN'], 0, 300) ?>...</p></em>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
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
            <!-- <div class="col-sm-6">
                <form method="post">
                    <div class="input-group">
                        <input class="form-control" type="text" name="" placeholder="Subcribe to get more promo" aria-label="Recipient's " aria-describedby="my-addon">
                        <div class="input-group-append">
                            <span class="input-group-text" id="my-addon">Text</span>
                        </div>
                    </div>
                </form>
            </div> -->
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
                <blockquote class="blockquote" style="margin: 10px;">
                    <p class="mb-0">About :</p>
                    <footer class="blockquote-footer"><?= $dataweb["ABOUT"] ?>
                    </footer>
                </blockquote>
            </div>
            <div class="row">
                <div class="col">
                    <p class="mb-0 text"><b>Active Link</b></p>
                    <ul class="list-unstyled">
                        <li><a href="/blog.php">Blog</a></li>
                        <li><a href="product.php">Produk</a></li>
                        <li><a href="blog.php?id=2">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col">
                    <p class="mb-0 text"><b>Contact info :</b></p>
                    <ul class="list-unstyled">
                        <li>Phone : <?= $dataweb["PHONE"] ?></li>
                        <li>Email : <?= $dataweb["EMAIL"] ?></li>
                        <li>Alamat :<?= $dataweb["ALAMAT"] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card" style="margin-top :10px">
    <div class="panel panel-default">
        <div class="panel-footer text-center">
            Copyright @inet 2019
        </div>
    </div>

</div>
</body>

</html>