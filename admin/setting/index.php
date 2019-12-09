<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}
$query = "SELECT*FROM MEMBER WHERE USER_ID = $_SESSION[id]";
$db = $Koneksi->prepare($query);
$db->execute();
$result = $db->fetch(PDO::FETCH_ASSOC);
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
            <h5>Settign - Account</h5>
            <hr>
            <form method="POST" action="../admin/setting/user-proses.php">
                <div class="form-group row">
                    <label for="user" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="user" placeholder="Username" value="<?= $result['USERNAME'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $result['EMAIL'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?= $result['ALAMAT'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="hidden" name="id" value="<?= $_SESSION["id"] ?>">
                        <input type="submit" name="simpan" value="simpan">
                    </div>
                </div>
            </form>

            <br>
            <h5>Passoword Setting - Account</h5>
            <hr>
            <form method="POST" action="../admin/setting/user-proses.php">
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="newPassword" placeholder="New Password">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Old Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="OldPassword" placeholder="Old Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="hidden" name="id" value="<?= $_SESSION["id"] ?>">
                        <input type="submit" value="Simpan Password">
                    </div>
                </div>
            </form>

            <br>
            <h5>Website Setting - Account</h5>
            <hr>
            <form method="POST" action="/admin/setting/websetting.php">
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Name Website</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" placeholder="Title of your website" value="<?= $dataweb["NAME"] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Website Slogan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="slogan" placeholder="Slogan of your website" value="<?= $dataweb["SLOGAN"] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-8">
                        <textarea name="about" class="form-control">
                            <?= $dataweb["ABOUT"] ?>
                        </textarea>
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">PHONE</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="phone" placeholder="Phone Contact" value="<?= $dataweb["PHONE"] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="email" placeholder="Email Contact" value="<?= $dataweb["EMAIL"] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="alamat" placeholder="alamat Contact" value="<?= $dataweb["ALAMAT"] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Harga router</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="router" placeholder="Phone Contact" value="<?= $dataweb["HARGA_ROUTER"] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="submit" value="Simpan Password">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>