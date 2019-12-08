<?php


session_start();
include("config/database.php");
if (isset($_SESSION["id"])) {
    header("location: ../user/index.php");
}
$msg = "";
$username = $_POST["username"];
$password = md5($_POST['password']);
if (isset($_POST["login"])) {
    $query = "SELECT * FROM MEMBER WHERE (USERNAME = :username OR EMAIL = :username) AND PASSWORD = :password";
    $db = $Koneksi->prepare($query);
    $data = array(
        ":username" => $username,
        ":password" => $password
    );
    $db->execute($data);
    $login = $db->fetch(PDO::FETCH_ASSOC);

    if ($login["USER_ID"] > 0) {
        $_SESSION["id"] = $login["USER_ID"];
        $_SESSION["user"] = $login["USERNAME"];
        $_SESSION["tipe"] = $login["TIPE_USER"];
        if ($_SESSION["tipe"] != 1) {
            header("location: ../user/index.php");
        } else {
            header("location: ../admin/index.php");
        }
    } else {
        $msg = "Username/Password Salah";
    }
}

include('header.php');

?>

<html>
<div class="container w-100">
    <div style="margin:auto; width: 60%; padding: 5rem 0px">
        <div class="row shadow-lg rounded-lg" style="padding: 20px 0px">
            <div class="col">
                <img src="img/Bg3.png" alt="" srcset="" width="310px">
            </div>
            <div class="col">
                <form method="POST">
                    <h5>Login</h5>
                    <hr>
                    <script>
                        $(document).ready(function() {
                            $("#msgAlert").slideDown();
                            $("#msgAlert").delay(3000);
                            $("#msgAlert").slideUp();
                        })
                    </script>
                    <?php
                    if (!($msg == "")) {
                        ?>
                        <div class="alert alert-success" id="msgAlert" style="display:none;">
                            <?= $msg ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control" type="text" name="username" placeholder="Username/email" aria-label="Recipient's ">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="my-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control" type="password" name="password" placeholder="Password" aria-label="Recipient's " aria-describedby="my-addon">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="login">Submit</button>
                        <div class="float-right text-right">
                            <br>
                            <a href="register.php">Not Have Account ?</a>
                        </div>
                    </div>
                </form>
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