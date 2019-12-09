<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
include($dir . "/config/database.php");

session_start();

if (!isset($_SESSION['id'])) {
    header("location:../login.php");
}


$queri = "SELECT * FROM PRODUK";
$db = $Koneksi->prepare($queri);
$db->execute();
$result_produk = $db->fetchAll();


$queri = "SELECT * FROM TIPE_PRODUK";
$db = $Koneksi->prepare($queri);
$db->execute();
$result_cat = $db->fetchAll();

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
            var harga_paket;

            <?php
            if (isset($_GET["idproduksi"])) {
                ?>
                $("#<?= $_GET['idproduk'] ?>").attr('selected', 'selected');
            <?php
            }
            ?>

            $("#produk").change(function() {
                get_produk();
                totalHarga();
            });
            $("#router").change(function() {
                var number = $(this).val();
                $("#router-form").val(number);
                totalHarga();
            })
            $("#jangkawaktu").change(function() {
                var number = $(this).val();
                $("#jangkawaktu-form").val(number);
                subTotal();
                totalHarga();
            })

            function subTotal() {
                var number = $("#jangkawaktu").val();
                var a = harga_paket * parseFloat(number);
                $("#produk-bill").val(a);
            }

            function totalHarga() {
                var harga_produk = harga_paket;
                var Router = $("#router").val();
                var bulan = $("#jangkawaktu").val();
                var subTotal = (harga_produk * parseFloat(bulan));
                var total = parseFloat(subTotal) + (parseFloat(<?= $dataweb["HARGA_ROUTER"] ?>) * parseFloat(Router));
                $("#total").val(total);
            }

            function get_produk() {
                var id = $('#produk').val();
                $("#produk-form").val(id);
                $.ajax({
                    url: '/order/get_produk.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#produk_view').html(data);
                        harga_paket = $(".harga_paket").val();
                        // alert(harga_paket)
                        totalHarga();
                        subTotal();
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
                        <li class="">Billing and Info</li>
                        <li class="">Finish</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container w-75">
        <div class="row" id="select-produk" style="margin-top:2rem">
            <div class=" col">
                <div class="row ">
                    <div class="col text-right">
                        <form class="w-100 float-right" style="padding-top: 1rem">
                            <div class="form-group">
                                <label for="produk">Produk</label>
                                <select class="form-control" id="produk">
                                    <?php
                                    foreach ($result_cat as $cat) {
                                        ?>
                                        <optgroup label="<?= $cat["NAMA_TIPE"] ?>">
                                            <?php
                                                foreach ($result_produk as $produk) {
                                                    if ($produk["ID_TIPE"] == $cat["ID_TIPE"]) {
                                                        ?>
                                                    <option value="<?= $produk["ID_PRODUK"] ?>" id="<?= $produk["ID_PRODUK"] ?>"><?= $produk["NAMA_PRODUK"] ?> @ <?= $produk["BIAYA"] ?></option>
                                            <?php
                                                    }
                                                }
                                                ?>
                                        </optgroup>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="my-input">Number of Router</label>
                                <input class="form-control" type="text" value="1" name="router" id="router">
                            </div>
                            <div class="form-group">
                                <label for="jangkawaktu">Jangka Waktu</label>
                                <select class="form-control" id="jangkawaktu">
                                    <option value="1">1 bulan</option>
                                    <option value="2">2 bulan</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <form action="/order/order-bill.php" method="POST">
                            <div class="col" style="border-left:1px solid blue">
                                <h5>Order Detail : </h5>
                                <input type="hidden" name="id" id="produk-form" value="">
                                <div class="card" id="produk_view">

                                </div>

                                <table class="table table-light">
                                    <tbody>
                                        <tr>
                                            <td>Router</td>
                                            <td>
                                                : <input class="w-50" type="text" name="router" value="1" readonly style="border:none;background: #fff" id="router-form">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Masa Waktu (bulan)</td>
                                            <td>: <input class=" w-50" type="text" name="waktu" readonly style="border:none;background: #fff" value="1" id="jangkawaktu-form">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Perpanjangan</td>
                                            <td>: <input class="w-75" type="text" name="bulan" id="produk-bill" readonly style="border:none;background: #fff"></td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Total</td>
                                            <td>: <input class="w-75" type="text" name="total" id="total" readonly style="border:none;background: #fff">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" name="next" class="btn btn-primary">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>