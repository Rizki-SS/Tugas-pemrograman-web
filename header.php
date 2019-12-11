<?php
session_start();
?>

<head>
    <link rel="stylesheet" href="/bootstrap-4.3.1/css/bootstrap.css">
    <link rel="stylesheet" href="/config/style.css">
    <script src="/bootstrap-4.3.1/js/bootstrap.js"></script>
    <script src="/bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script src="/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/cd4fbae50a.js"></script>
    <style>
        .card-body ul li {
            list-style: none;
        }

        .card-body ul {

            margin-left: -2rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-right shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/index.php"><img src="/img/Logo.png" width="150px"></a>
            <nav class="nav nav-fill">
                <li class="nav-item">
                    <a class="nav-link " href="/product.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/blog.php">Blog</a>
                </li>
                <?php
                if (!isset($_SESSION["id"])) { ?>
                    <li class="nav-item">
                        <a class="nav-link " href="login.php">Login</a>
                    </li>
                <?php
                } else {
                    ?>
                    <?php
                        if ($_SESSION["id"] == 1) {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link " href="/admin">Admin Panel</a>
                        </li>
                    <?php
                        } else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link " href="/user">User Panel</a>
                        </li>
                    <?php
                        }
                        ?>
                <?php
                }
                ?>

            </nav>
        </div>
    </nav>