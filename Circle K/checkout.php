<?php
session_start();

$koneksi = new mysqli("localhost","root","","circle_k");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CheckOut</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
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
            <h1>Checkout Keranjang Belanja</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php foreach ($_SESSION['keranjang'] as $id_product => $jumlah): ?>
                    <?php
                    $ambil=$koneksi->query("SELECT * FROM product WHERE id_product='$id_product' ");
                    $pecah = $ambil->fetch_assoc();
                    $subharga =$pecah["harga_product"]*$jumlah;
                    ?>

                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah["nama_product"]; ?></td>
                        <td>Rp. <?php echo number_format($pecah["harga_product"]); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php endforeach ?>
                </tbody>
            </table>
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan'] ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="id_ongkir">
                                <option value="<?php echo $perongkir['id_ongkir'] ?>">Pilih Ongkos kirim</option>
                                <?php 
                                $ambil = $koneksi->query("SELECT * FROM ongkir");
                                while ($perongkir = $ambil->fetch_assoc()){ 
                                    ?>
                                    <option value="">
                                        <?php echo $perongkir['nama_kota'] ?>
                                        Rp. <?php echo number_format($perongkir['tarif']) ?>
                                        </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </form>
        </div>
    </section>

    <pre><?php print_r($_SESSION['pelanggan']) ?></pre>

</body>
</html>