<?php
if ($_SESSION["tipe"] != 1) {
        header("location:/user/index.php");
}
?>

<ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="/admin/user"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        User</a></li>
        <li class="nav-item list-group-item">
                <a class="collapsed" href="#submenu1" data-toggle="collapse" data-target="#submenu1"><i class="fa fa-table"></i> Produk</a>
        </li>
        <div class="collapse icon" id="submenu1" aria-expanded="false" style="padding: 0px 20px;">
                <li class="nav-item list-group-item"><a href="/admin/servis/"><i class="fa fa-product-hunt" aria-hidden="true"></i>
                                Service</a></li>
                <li class="nav-item list-group-item"><a href="/admin/kategori"><i class="fa fa-server" aria-hidden="true"></i>
                                Kategori</a></li>
        </div>

        <li class="nav-item list-group-item">
                <a class="collapsed" href="#submenu2" data-toggle="collapse" data-target="#submenu2"><i class="fa fa-table"></i> Penjualan</a>
        </li>
        <div class="collapse icon" id="submenu2" aria-expanded="false" style="padding: 0px 20px;">
                <li class="list-group-item"><a href="/admin/order"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                Order List</a></li>
                <li class="list-group-item"><a href="/admin/pembayaran"><i class="fa fa-money" aria-hidden="true"></i>
                                Pembayaran</a></li>
        </div>

        <li class="list-group-item"><a href="/admin/blog"><i class="fa fa-th-large" aria-hidden="true"></i>
                        Blog</a></li>
        <li class="list-group-item"><a href="/admin/help/"><i class="fa fa-ticket" aria-hidden="true"></i>
                        HelpDesk</a></li>
        <li class="list-group-item"><a href="/admin/setting"><i class="fa fa-cog" aria-hidden="true"></i>
                        Setting</a></li>
        <li class="list-group-item"><a href="/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
                        Logout</a></li>
</ul>