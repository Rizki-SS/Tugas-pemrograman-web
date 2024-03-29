<?php

include('config/database.php');

if (isset($_SESSION["id"])) {
    header("location:index.php");
}
$msg = "";
if (isset($_POST["register"])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pas = "";
    if (strlen($_POST['password']) >= 6) {
        if ($_POST['password'] == $_POST['password2']) {
            $pas = md5($_POST['password']);
        } else {
            $msg = "password anda salah";
        }
    } else {
        $msg = "Panjang Charakter Password Minimal 6";
        // $msg = ($password = md5($_POST['password']));
    }

    $chek = "SELECT USER_ID, EMAIL FROM MEMBER WHERE USERNAME = :username OR EMAIL = :email";
    $db = $Koneksi->prepare($chek);
    $data = array(
        ":username" => $username,
        ":email"    => $email
    );
    $db->execute($data);
    $chek_id = $db->fetch(PDO::FETCH_ASSOC);
    if ($chek_id["USER_ID"] > 0) {
        $msg = "Username/email di gunakan";
    } else {
        if ($msg == "") {
            $sql = "INSERT INTO MEMBER VALUES (NULL,:username,:password,:email,NULL,2)";
            $db = $Koneksi->prepare($sql);
            $data = array(
                ":username" => $username,
                ":password" => $pas,
                ":email"    => $email
            );
            $input = $db->execute($data);
            if ($input) {
                header("location:login.php");
            } else {
                // $msg = mysqli_error($db);
            }
        }
    }
}

include('header.php');

?>

<html>
<div class="container w-100">
    <div style="margin:auto; width: 60%; padding: 5rem 0px">
        <div class="row shadow-lg rounded-lg" style="padding-top: 20px">
            <div class="col">
                <img src="img/Bg3.png" alt="" srcset="" width="310px">
            </div>
            <div class="col">
                <form method="POST">
                    <h5>Register</h5>
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
                            <input class="form-control" type="text" name="username" placeholder="Username" aria-label="Recipient's ">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="my-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control" type="text" name="email" placeholder="Email" aria-label="Recipient's " aria-describedby="my-addon">
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
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="my-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control" type="password" name="password2" placeholder="Reenter Password" aria-label="Recipient's " aria-describedby="my-addon">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="register">Submit</button>
                        <a class="float-right" href="login.php">You Have Account ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<div class="card fixed-bottom" style="margin-top :10px">
    <div class="panel panel-default">
        <div class="panel-footer text-center">
            Copyright @inet 2019
        </div>
    </div>

</div>
</body>

</html>