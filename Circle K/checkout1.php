<?php
session_start();
$koneksi = new mysqli("localhost","root","","circle_k");

if (!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
}
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
            <h1>Keranjang Belanja</h1>
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
                    <?php $totalbelanja=0; ?>
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
                    <?php $totalbelanja+=$subharga; ?>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                </tfoot>
            </table>
            <form method="post">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_ongkir">
                            <option value="">pilih ongkos kirim </option>
                            <?php 
                            $ambil = $koneksi->query("SELECT * FROM ongkir ");
                            while($perongkir = $ambil->fetch_assoc()){
                             ?>
                            <option value="<?php echo $perongkir["id_ongkir"] ?>">
                                <?php echo $perongkir['nama_kota'] ?> -
                                Rp. <?php echo number_format($perongkir['tarif']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary name="checkout1">Checkout</button>
            </form>
           
            <?php 
            if (isset($_POST["checkout1"]))
            {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $id_ongkir = $_POST["id_ongkir"];
                $tanggal_pembelian = date("Y-m-d");

                $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $arrayongkir = $ambil->fetch_assoc();
                $tarif = $arrayongkir['tarif'];

                $total_pembelian = $totalbelanja + $tarif;

                $koneksi->query("INSERT INTO 'pembelian'(id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian) VALUES ('[$id_pelanggan]','[$id_ongkir]','[$tanggal_pembelian]','[$total_pembelian]' ) ");

               $id_pembelian_barusan = $koneksi->insert_id;

               foreach ($_SESSION["keranjang"] as $id_product => $jumlah)
               {
                   $koneksi->query("INSERT INTO 'pembelian_product' (id_pembelian,id_product,jumlah)
                    VALUES ('[$id_pembelian]','[$id_product]','[$jumlah]') ");}

               echo "<script>alert('pembelian sukses');</script>";
               echo "<script>location='note.php?id=$id_pembelian_barusan';</script>";
            }

             ?>

        </div>
    </section>
    <pre><?php print_r($_SESSION['pelanggan']) ?></pre>
    <pre><?php print_r($_SESSION['keranjang']) ?></pre>
    <pre><?php echo $koneksi->insert_id; ?></pre>


</body>
</html>