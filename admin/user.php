<?php
include("../header.php");
include("../config/database.php");
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
            include("sidebar.php");
            ?>
        </div>
        <div class="col">
            <br>
            <div class="row">
                <div class="col">
                    <h4>User</h4>
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
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Address</th>
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
                            <td class="w-25">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-block btn-info">button</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-block btn-info">button</button>
                                    </div>
                                </div>
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