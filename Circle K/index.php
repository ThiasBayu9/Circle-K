<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Circle K</title>
    <link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
<?php
session_start();
$koneksi = new mysqli("localhost","root","","circle_k");
?>
</head>
<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="Keranjang.php">Keranjang</a></li>
                <?php if (isset($_SESSION["pelanggan"])): ?>
                 <li><a href="logout.php">Logout</a></li>


             <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif?>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
         </div>
    </nav>

    <section class="konten">
        <div class="container">
            <h1>Product</h1>
            <div class="row">


                <?php $ambil = $koneksi->query("SELECT * FROM product"); ?>
                <?php while($perproduct=$ambil->fetch_assoc()){ ?>
                <div class="col-md-3">
                  <div class="thumbnail">
                   <img src="foto_product/<?php echo $perproduct['foto_product']; ?>" alt="">
                   <div class="caption">
                       <h3><?php echo $perproduct['nama_product']; ?></h3>
                       <h5>Rp.<?php echo $perproduct['harga_product']; ?></h5>
                       <a href="beli.php?id=<?php echo $perproduct['id_product']; ?>" class="btn btn-primary">Beli</a>
                   </div>
                </div>
            </div>
        <?php }?>


        </div>
        </div>
    </section>

</body>
</html>