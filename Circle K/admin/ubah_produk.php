<h2 class="text-center">Ubah product</h2>

<?php
$ambil = $koneksi->query("SELECT * FROM product WHERE id_product = '$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<pre><?php print_r($pecah); ?></pre>

<form method="post" enctype="multipart/form-data">
   <div class="form-group">
	<label>Nama product</label>
	<input type="text" name="nama"  class="form-control" value="<?php echo $pecah['nama_product'] ?>">		
</div>
   <div class="form-group">
	<label>Harga (Rp)</label>
	<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_product'] ?>">		
</div>

<div class="form-group">
	<div class="form-group">
		<img src="../foto_product/<?php echo $pecah['foto_product'] ?>" widt="200" height="150">
	</div>
	<div class="form-group">
		<label>Ganti Foto product</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
		<label>Deskripsi product</label>
		<textarea name="deskripsi" class="form-control" rows="5">
		<?php echo $pecah['deskripsi_product']; ?>
		</textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
	<a href="index.php?halaman=product" class="btn btn-warning">Kembali</a>

</form>

<?php
	if (isset($_POST['ubah'])) {
		$nama = $_FILES['foto']['name'];
		$lokasi =$_FILES['foto']['tmp_name'];


		if(!empty($lokasi)){
			move_uploaded_file($lokasi, "../foto_product/$nama");

		$koneksi->query("UPDATE product SET nama_product = '$_POST[nama]',harga_product = '$_POST[harga]',
			foto_product = '$nama' ,deskripsi_product = '$_POST[deskripsi]' WHERE id_product = '$_GET[id]'");

	} else{
		$koneksi->query("UPDATE product SET nama_product = '$_POST[nama]',harga_product = '$_POST[harga]',
			foto_product = '$nama' ,deskripsi_product = '$_POST[deskripsi]' WHERE id_product = '$_GET[id]'");
	}
	echo"<script>alert('Data Berhasil Diubah');</script>";
	echo"<script>location='index.php?halaman=product';</script>";
}
?>