<?php
include('header.php');
include('config/database.php');

$msg = "";


//get Post All
$query = "SELECT*FROM BLOG WHERE STATUS = 0 ORDER BY DATE DESC LIMIT 8";
$db = $Koneksi->prepare($query);
$db->execute();
$result_blog = $db->fetchAll();

?>


<div class="container" style="margin-top:20px; margin-bottom:20px">

    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 " style="padding: 10px">

            <?php
            if (!isset($_GET['id'])) {
                foreach ($result_blog as $key) {
                    ?>

                    <div class="row w-100">
                        <div class="col">
                            <h2><?= $key['TITLE'] ?></h2>
                            <hr>
                            <small><?= $key['DATE'] ?></small>
                            <p class="m-25">
                                <?= substr($key['CONTEN'], 0, 300) ?>...
                            </p>
                            <a href="../blog.php?id=<?= $key['ID_BLOG'] ?>" type="button" class="btn btn-large btn-block btn-default">button</a>

                        </div>
                    </div>

                <?php
                    }
                } else {
                    //get Post
                    $query = "SELECT*FROM BLOG WHERE ID_BLOG=$_GET[id]";
                    $db = $Koneksi->prepare($query);
                    $db->execute();
                    $result_blog1 = $db->fetch(PDO::FETCH_ASSOC);

                    //get komentar
                    $query = "SELECT*FROM KOMENTAR WHERE ID_BLOG=$_GET[id]";
                    $db = $Koneksi->prepare($query);
                    $db->execute();
                    $result = $db->fetchAll();

                    ?>

                <h2><?= $result_blog1['TITLE'] ?></h2>
                <hr>
                <small><?= $result_blog1['DATE'] ?></small>
                <div class="m-25">
                    <?= $result_blog1['CONTEN'] ?>
                </div>

                <h5>Komentar</h5>
                <br>

                <?php
                    foreach ($result as $key) {
                        ?>
                    <div class="row">
                        <div class="col">
                            <h6><?= $key["NAMA"] ?></h6>
                            <small><?= $key["DATE"] ?></small>
                            <p><?= $key["KOMENTAR"] ?></p>
                        </div>
                    </div>
                <?php
                    }
                    ?>
                <form action="post_komen.php" method="POST" style="margin-top:20px">
                    <div class="form-row">
                        <div class="col">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="name">
                        </div>
                        <div class="col">
                            <label for="input">Email</label>
                            <input type="email" name="email" id="input" class="form-control" value="" required="required" title="" placeholder="Email">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="my-textarea">Text</label>
                        <textarea id="my-textarea" class="form-control" name="isi" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                    <button type="submit" class="btn btn-primary" name="kirim">Submit</button>

                </form>

            <?php

            }
            ?>

        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 vh-100">
            <h4>Sidebar</h4>
            <hr>
            <ul class="list-unstyled">

                <?php
                foreach ($result_blog as $key) {
                    ?>
                    <li class="list-group-item w100"><?= $key["TITLE"] ?></li>
                <?php
                }
                ?>

            </ul>
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