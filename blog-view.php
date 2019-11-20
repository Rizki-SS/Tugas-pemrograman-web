<?php
include('header.php');
include('config/database.php');

$msg = "";

//get Post
$query = "SELECT*FROM BLOG WHERE ID_BLOG==$_POST[id]";
$db = $Koneksi->prepare($query);
$db->execute();
$result_blog = $db->fetch_assoc();


//get komentar
$query = "SELECT*FROM KOMENTAR WHERE ID_BLOG==$_POST[id]";
$db = $Koneksi->prepare($query);
$db->execute();
$result = $db->fetchAll();

//post Komentar
if (isset($_POST["kirim"])) {
    if (FILTER_VALIDATE_EMAIL($_POST["email"])) {
        $query = "INSERT INTO KOMENTAR VALUES (NULL,:nama,:email,:komentar,NOW(),:id)";
        $db = $Koneksi->prepare($query);
        $data = array(
            ":nama"     => $_POST("nama"),
            ":email"    => $_POST("email"),
            ":komentar" => $_POST("isi")
        );
        if ($db->execute($data)) {
            header("location:blog.php?id=" . $_POST["id"]);
        } else {
            $msg = "Error, Post Komentar Gagal";
        }
    }
}
?>


<div class="container" style="margin-top:20px; margin-bottom:20px">

    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 " style="padding: 10px">
            <h2><?= $result_blog['TITLE'] ?></h2>
            <hr>
            <small><?= $result_blog['DATE'] ?></small>
            <div class="m-25">
                <?= $result_blog['CONTEN'] ?>
            </div>
            <form action="" method="post" style="margin-top:20px">
                <h5>Komentar</h5>
                <br>

                <?php
                foreach ($result as $key) {
                    ?>
                    <div class="row">
                        <h6><?= $key["NAMA"] ?></h6>
                        <small><?= $key["DATE"] ?></small>
                        <p><?= $key["KOMENTAR"] ?></p>
                    </div>
                <?php
                }
                ?>

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

                <button type="submit" class="btn btn-primary" name="kirim">Submit</button>

            </form>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 vh-100">
            <h4>Sidebar</h4>
            <hr>
            <ul class="list-unstyled">

                <?php
                // loop get sidebar
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