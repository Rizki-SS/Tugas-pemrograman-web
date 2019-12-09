<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$query = "SELECT*FROM MEMBER";
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
            include($dir . "/admin/sidebar.php");
            ?>
        </div>
        <div class="col">
            <br>
            <div class="row">
                <div class="col">
                    <h4>User</h4>
                </div>
            </div>
            <?php
            $msg = $_GET["msg"];
            if (!empty($msg)) {
                ?> <div class="alert alert-success" id="msgAlert" style="display:none;">
                    <?= $msg ?>
                </div>
                <script>
                    $(document).ready(function() {
                        $("#msgAlert").slideDown();
                        $("#msgAlert").delay(3000);
                        $("#msgAlert").slideUp();
                    });
                </script>
            <?php
            }
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["USER_ID"] ?></th>
                            <td><?= $key["USERNAME"] ?></td>
                            <td><?= $key["EMAIL"] ?></td>
                            <td><?= $key["ALAMAT"] ?></td>
                            <td>
                                <?php
                                    if ($key["TIPE_USER"] == 1) {
                                        echo '<b> Admin </b>';
                                    } else
                                    if ($key["TIPE_USER"] == 2) {
                                        echo 'User';
                                    } else {
                                        echo 'BlackList';
                                    }
                                    ?>

                            </td>
                            <td>
                                <a href="/admin/user/user-edit.php?id=<?= $key["USER_ID"] ?>" type="button" class="btn btn-block btn-info">

                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
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