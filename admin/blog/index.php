<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$query = "SELECT*FROM BLOG";
$db = $Koneksi->prepare($query);
$db->execute();
$result = $db->fetchAll();

$msg = $_GET["msg"];
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
                    <h4>Blog</h4>
                </div>
                <div class="col">
                    <div class="float-right">
                        <a href="/admin/blog/blog-edit.php" type="button" class="btn btn-sm btn-block btn-info"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add New
                        </a>
                    </div>
                </div>
            </div> <?php if (!empty($msg)) {
                        ?> <div class="alert alert-success" id="msgAlert" style="display:none;">
                    <?= $msg ?>
                </div>
            <?php
            }
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col-sm-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["ID_BLOG"] ?></th>
                            <td><?= $key["TITLE"] ?></td>
                            <td><?= $key["DATE"] ?></td>
                            <td><?php
                                    if ($key["STATUS"] == 1) {
                                        echo "Draf";
                                    } else {
                                        echo "Publish";
                                    }
                                    ?></td>
                            <td>
                                <div class="row">
                                    <a href="/admin/blog/blog-edit.php?id_post=<?= $key["ID_BLOG"] ?>" type="button" class="btn btn-info">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <button style="margin-left: 5px;" data-id="<?= $key["ID_BLOG"] ?>" type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>

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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/blog/blog-delete.php" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $("#msgAlert").slideDown();
        $("#msgAlert").delay(3000);
        $("#msgAlert").slideUp();
        $('.delete').click(function() {
            var ID = $(this).data('id');
            $("#id").val(ID);
        });
    });
</script>

</html>