<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}


$query = "SELECT*FROM PRODUK AS P JOIN TIPE_PRODUK AS TP ON P.ID_TIPE=TP.ID_TIPE";
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
                    <h4>Produk - Servis</h4>
                </div>
                <div class="col">
                    <div class="float-right">
                        <a href="/admin/servis/servis-edit.php" type="button" class="btn btn-sm btn-block btn-info"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add New
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Speed</th>
                        <th scope="col">Ket</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["ID_PRODUK"] ?></th>
                            <td><?= $key["NAMA_TIPE"] ?></td>
                            <td><?= $key["NAMA_PRODUK"] ?></td>
                            <td><?= $key["BIAYA"] ?></td>
                            <td><?= $key["SPEED"] ?></td>
                            <td><?= $key["KET"] ?></td>
                            <td>
                                <div class="row">
                                    <a style="margin: 5px;" href="/admin/servis/servis-edit.php?id_post=<?= $key["ID_PRODUK"] ?>" type="button" class="btn btn-info">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <button style="margin: 5px;" data-id="<?= $key["ID_PRODUK"] ?>" type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#exampleModal">
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
            <form action="/admin/servis/servis-delete.php" method="get">
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