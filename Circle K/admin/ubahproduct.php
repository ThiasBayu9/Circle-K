<h2>Ubah Product</h2>
<?php
	$ambil=$koneksi->query("SELECT * FROM product WHERE id_product='$_GET[id]'");
	$pecah=$ambil->fetch_assoc();

	echo "<pre>";
	print_r($pecah);
	echo "</pre>";
	?>

	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama Product</label>
			<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_product']; ?>">
		</div>
		<div class="form-group">
			<label>Harga Rp</label>
			<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_product']; ?>">
		</div>
		<div class="form-group">
			<img src="../foto_product/<?php echo $pecah['foto_product'] ?>" widt="">
		</div>
		<div class="form-group">
			<label>Ganti Foto</label>
			<input type="file" name="foto" class="form-control">
		</div>
		<div class="form-group">
			<label>Deskripsi</label>
			<textarea name="Deskripsi" class="form-control" rows="10"><?php echo $pecah['deskripsi_product']; ?>
			</textarea>
		</div>
		<button class="btn btn-primary" name="ubah">Ubah</button>
	</form>

	




<?php
if (isset($_POST['ubah']))
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];

	if (!empty($lokasifoto)) 
	{
	move_uploaded_file($lokasifoto,"../foto_product/$namafoto");

	$koneksi->query("UPDATE product SET nama_produk='$_POST[nama]'
	,'harga_product='$_POST[harga]','foto_product='$namafoto','deskripsi_product=$_POST[deskripsi]' 
	WHERE id_product='$_GET[id]'");
	}
	else
	{
		$koneksi->query("UPDATE product SET nama_produk='$_POST[nama]',harga_product='$_POST[harga]'
		,deskripsi_product='$_POST[deskripsi]' WHERE id_product='$_GET[id]'");

	}
	echo "<script>alert('data product telah diubah');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=product'>";
}
?>