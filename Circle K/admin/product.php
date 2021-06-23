<h2>Data Product</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>nama</th>
			<th>harga</th>
			<th>foto</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM product");?>
		<?php  while ($pecah = $ambil -> fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['nama_product'];?></td>
			<td><?php echo $pecah['harga_product'];?></td>
			<td><img src="../foto_product/<?php echo $pecah['foto_product']; ?>" widt=""></td>
			<td>
				<a href="index.php?halaman=hapusproduct&id=<?php echo $pecah['id_product']; ?>" class="btn-danger btn">hapus</a>
				<a href="index.php?halaman=ubah_produk&id=<?php echo $pecah['id_product']; ?>" class="btn btn-warning">ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>

	</tbody>
</table>
<a href="index.php?halaman=tambahproduct" class="btn btn-primary">Tambah Data</a>