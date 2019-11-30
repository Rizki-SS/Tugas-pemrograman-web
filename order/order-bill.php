<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("location:../login.php");
}

if (!isset($_POST["id"])) {
    header("location:index.php");
}

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
                        <li class="">Finish</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container w-75">
        <div class="row" id="select-produk" style="margin-top:2rem">
            <div class="col">
                <form action="../order/finish.php" method="POST" class="w-100 ">
                    <div class="row">
                        <div class="col text-right">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input class="form-control" type="text" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input class="form-control" type="text" name="alamat">
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input class="form-control" type="text" name="telp">
                            </div>
                            <div class="form-group">
                                <label for="jenis_Pembayaran">Jenis Pembayaran</label>
                                <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran">
                                    <option value="1">Bayar Saat Pemasangan</option>
                                    <option value="2">Bayar Tranfer Bank</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="my-textarea">Keterangan</label>
                                <textarea id="my-textarea" class="form-control" name="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4" style="border-left:1px solid blue" style="padding-top: 1rem">
                            <h5>Order Detail : </h5>
                            <input type="hidden" name="id" id="produk-form" value="<?= $_POST["id"] ?>">
                            <div class="card" id="produk_view">

                            </div>

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
                                </tbody>
                            </table>
                            <button type=" submit" class="btn btn-primary">Korfirmasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>