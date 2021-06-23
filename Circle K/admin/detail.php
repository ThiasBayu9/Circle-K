<h2>Detail Pembelian</h2>
<?php
	$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $ambil->fetch_assoc();
?>
<pre><?php print_r($detail); ?></pre> 

<strong><?php echo $detail['nama_pelanggan'];?></strong> <br>
<p>
	<?php echo $detail['telepon_pelanggan'];?> <br>
	<?php echo $detail['email_pelanggan'];?>
</p>

<p>
	tanggal:<?php echo $detail['tanggal_pembelian'];?> <br>
	Total: <?Php echo $detail['total_pembelian']; ?>
</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>no</th>
			<th>nama product</th>
			<th>harga</th>
			<th>jumlah</th>
			<th>subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_product JOIN product ON pembelian_product.id_product=product.id_product WHERE pembelian_product.id_pembelian='$_GET[id]' "); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_product']; ?></td>
			<td><?php echo $pecah['harga_product']; ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo $pecah['harga_product']*$pecah['jumlah']; ?></td>
		</tr>
		<?php $nomor++; ?>
	<?php }?>
	</tbody>
</table>