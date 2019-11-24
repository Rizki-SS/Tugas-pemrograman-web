<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$query = "SELECT*FROM TIPE_PRODUK";
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
                    <h4>Kategori</h4>
                </div>
                <div class="col">
                    <div class="float-right">
                        <form action="/admin/kategori/kategori-edit.php" method="get">
                            <input type="text" name="kategori_name">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["ID_TIPE"] ?></th>
                            <td><?= $key["NAMA_TIPE"] ?></td>
                            <td>
                                <div class="row">
                                    <button style="margin-left: 5px;" data-id="<?= $key["ID_TIPE"] ?>" type="button" class="btn btn-info edit" data-toggle="modal" data-target="#edit_modal">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button style="margin-left: 5px;" data-id="<?= $key["ID_TIPE"] ?>" type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#delete">
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
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/kategori/kategori-edit.php" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus kategori ini?
                    <p>
                        <small> Catatan : Menghapus kategori mengakibatkan produk dalam kategori ini tidak akan tampil dalam halaman produk karena kategori tidak ada</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id1">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/kategori/kategori-edit.php" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_modal">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="input">Masukan Nama Baru : </label>
                    <input type="text" name="kategori_name">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="id">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
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
            var id = $(this).data('id');
            $("#id1").val(id);
        });
        $('.edit').click(function() {
            var id = $(this).data('id');
            $("#id").val(id);
        });
    });
</script>

</html>