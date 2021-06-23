<?php

$ambil=$koneksi->query("SELECT * FROM product WHERE id_product='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();
$fotoproduct=$pecah['foto_product'];
if (file_exists("../foto_product/$fotoproduct")) 
{
	unlink("../foto_product/$fotoproduct");
}


$koneksi->query("DELETE FROM product WHERE id_product='$_GET[id]' ");

echo "<script>alert('produng terhapus');</script>";
echo "<script>location=index.php?halaman=product';</script>"
?>