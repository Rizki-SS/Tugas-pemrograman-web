<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("location:../login.php");
}

if (!isset($_POST["id"])) {
    header("location:index.php");
}


$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");
$queri = "SELECT * FROM PRODUK WHERE ID_PRODUK=$_POST[id]";
$db = $Koneksi->prepare($queri);
$db->execute();
$key1 = $db->fetch(PDO::FETCH_ASSOC);

?>

<html>

<head>
    <link rel="stylesheet" href="../bootstrap-4.3.1/css/bootstrap.min.css">
    <script src="../bootstrap-4.3.1/js/bootstrap.js"></script>
    <script src="../bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <script src="../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <style>
        .wrapper-progressBar {
            width: 100%
        }

        .progressBar li {
            list-style-type: none;
            float: left;
            width: 33%;
            position: relative;
            text-align: center;
        }

        .progressBar li:before {
            content: " ";
            line-height: 30px;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            display: block;
            text-align: center;
            margin: 0 auto 10px;
            background-color: white
        }

        .progressBar li:after {
            content: "";
            position: absolute;
            width: 100%;
            height: 4px;
            background-color: #ddd;
            top: 15px;
            left: -50%;
            z-index: -1;
        }

        .progressBar li:first-child:after {
            content: none;
        }

        .progressBar li.active {
            color: dodgerblue;
        }

        .progressBar li.active:before {
            border-color: dodgerblue;
            background-color: dodgerblue
        }

        .progressBar .active:after {
            background-color: dodgerblue;
        }
    </style>
    <script>
        $(document).ready(function() {
            get_produk();

            function get_produk() {
                var id = <?= $_POST["id"] ?>;
                $.ajax({
                    url: '../order/get_produk.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#produk_view').html(data);
                    }
                })
            }
        })
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-right shadow-sm">
        <div class="container">
            <a class="navbar-brand m-auto"><img src="../img/Logo.png" width="150px"></a>
        </div>
    </nav>

    <div class="container">
        <div class="row" style="padding: 1rem">
            <div class="col-xs-12 col-md-8 offset-md-2">
                <div class="wrapper-progressBar">
                    <ul class="progressBar">
                        <li class="active">Select Product</li>
                        <li class="active">Billing and Info</li>
                        <li class="active">Finish</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container w-50">
        <div class="row">
            <div class="col">
                <form action="../order/input.php" method="POST">
                    <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                    <h4>Summary</h4>
                    <hr>
                    <br>
                    <h6>Contact Detai : </h6><br>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationTooltip01">Name</label>
                            <input type="text" name="nama" class="form-control" value="<?= $_POST['nama'] ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationTooltip02">Contact</label>
                            <input type="text" name="telp" class="form-control" value="<?= $_POST['telp'] ?>">
                        </div>
                    </div>
                    <label for="validationTooltip02">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?= $_POST['alamat'] ?>">
                    <br>
                    <h6>Detail Pemesanan : </h6>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card text-center">
                                <div class="card-body" style="padding-left:0px;padding-right:0px!important">
                                    <h5 class="card-title"><?= $key1["NAMA_PRODUK"] ?></h5>
                                    <h4 class="display-5 bg-info text-white" style="padding :15px">Rp.<?= $key1["BIAYA"] ?></h4>
                                    <img src="../img/speedometer.svg" alt="" srcset="" width="30%">
                                    <h3><?= $key1["SPEED"] ?></h3>
                                    <br>
                                    <?= $key1["KET"] ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <table class="table table-light">
                                <tbody>
                                    <tr>
                                        <td>Router</td>
                                        <td>: <input type="text" class="w-50" name="router" readonly style="border:none;background: #fff" id="router-form" value="<?= $_POST["router"] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Masa Waktu (bulan)</td>
                                        <td>: <input class=" w-50" type="text" name="waktu" readonly style="border:none;background: #fff" value="<?= $_POST["waktu"] ?>" id="jangkawaktu-form">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Bulanan</td>
                                        <td>: <input type="text" class="w-75" name="bulan" id="produk-bill" readonly style="border:none;background: #fff" value="<?= $_POST["bulan"] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Total</td>
                                        <td>: <input type="text" class=" w-75" name="total" id="total" readonly style="border:none;background: #fff" value="<?= $_POST["total"] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Metode Pembayaran</td>
                                        <?php
                                        if ($_POST["jenis_pembayaran"] == 1) {
                                            $b =  "Bayar saat pemasanagan";
                                        } else {
                                            $b =  "Bayar Transfer";
                                        }
                                        ?>
                                        <td>: <input type="text" name="metode" id="total" readonly style="border:none;background: #fff" value="<?= $b ?>">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Saya setuju dengan semua ketentuan persyaratan
                        </label>
                    </div>
                    <hr>
                    <script>
                        $(document).ready(function() {
                            $('.print').click(function() {
                                window.print();
                            })
                        })
                    </script>

                    <div class="col-sm-6 float-left">

                        <button type="button" class="btn btn-large btn-block btn-default print">Print</button>

                    </div>
                    <div class="col-sm-6 float-right">
                        <button type="submit" class="btn btn-large btn-block btn-default">Konfirm</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>