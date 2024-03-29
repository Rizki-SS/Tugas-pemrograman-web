<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
include($dir . "/header.php");
if (!isset($_SESSION["id"])) {
    header("location:../index.php");
}

$query = "SELECT*FROM HELPDESK WHERE ID_MEMBER = :id";
$db = $Koneksi->prepare($query);
$data = array(
    ":id" => $_SESSION["id"]
);
$db->execute($data);
$result = $db->fetchAll();
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
            <div class="row">
                <div class="col">
                    <h4>Help Desk</h4>
                </div>
                <div class="col">
                    <div class="float-right">
                        <button type="button" class="btn btn-info edit" data-toggle="modal" data-target="#edit_modal"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
                    </div>
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
                        <th scope="col">Kode Pesanan</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $key) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key["ID"] ?></th>
                            <td><?= $key["ID_PESANAN"] ?></td>
                            <td><?= $key["JUDUL"] ?></td>
                            <td><?= $key["KETERANGAN"] ?></td>
                            <td>
                                <?php
                                    if ($key["STATUS"] == 0) {
                                        echo "ACTIVE";
                                    } else {
                                        echo "CLOSE";
                                    }
                                    ?>
                            </td>
                            <td>
                                <div class="row">
                                    <button style="margin: 5px;" data-id="<?= $key["ID"] ?>" type="button" class="btn btn-warning view" data-toggle="modal" data-target="#view">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                    <?php

                                        if ($key["STATUS"] == 0) {
                                            ?>
                                        <button style="margin: 5px;" data-id="<?= $key["ID"] ?>" type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#delete">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    <?php
                                        } else {
                                            ?>
                                        <button disabled style="margin: 5px;" data-id="<?= $key["ID"] ?>" type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#delete">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    <?php
                                        }
                                        ?>
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
            <form action="/user/help/delete.php" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete">Tutup Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menutup tiket ini?
                    <p>
                        <small> Catatan : Tiket Bantuan tidak akan terhapus akan tetapi akan di tutup</small>
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
            <form action="/user/help/add.php" method="get">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_modal">Ajukan Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="my-input">Kode Pesanan : </label>
                        <select name="kode_pesanan" id="my-input">
                            <?php
                            $sql = "select KODE_PESANAN from PESANAN WHERE USER_ID = :id";
                            $db1 = $Koneksi->prepare($sql);
                            $db1->execute($data);
                            $result1 = $db1->fetchAll();
                            foreach ($result1 as $key1) {
                                ?>
                                <option value="<?= $key1["KODE_PESANAN"] ?>"><?= $key1["KODE_PESANAN"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class=" form-group">
                        <label for="my-input">Judul</label>
                        <input id="my-input" class="form-control" type="text" name="judul">
                    </div>
                    <div class=" form-group">
                        <label for="my-input">Keterangan</label>
                        <textarea id="my-input" class="form-control" name="ket" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="view">Lihat Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="view-conten">




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var id = $(this).data('id');
            $("#id1").val(id);
        });

        $(".view").click(function() {
            var id = $(this).data("id");
            $.ajax({
                url: '/user/help/view.php',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#view-conten').html(data);
                }
            })
        })
    });
</script>

</html>