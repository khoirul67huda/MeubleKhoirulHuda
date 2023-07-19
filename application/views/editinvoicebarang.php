<!DOCTYPE html>
<html lang="en">

<?php include 'part/head.php' ?>

<body id="page-top">


	<?php include 'part/sidebar.php' ?>

	<!-- Main Content -->
	<div id="content">

		<!-- Topbar -->
		<?php include 'part/navbar.php' ?>
		<div class="container-fluid">
			<!-- ------------( batas Awal Isi Halaman )------------ -->

			<a href="<?= base_url('admin/invoice_po/' . $dt->kode_po) ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
			<div class="card shadow mb-1">
				<div class="card-header">
					<h4><?= $dt->kode_buyer . '-' . $dt->kode_po ?></h4>
				</div>
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name='id' value="<?= $dt->id_invoice ?>">
						<input type="hidden" name='kode_po' value="<?= $dt->kode_po ?>">
						<input type="hidden" name='kode_buyer' value="<?= $dt->kode_buyer ?>">


						<div class="form-group">
							<label>pilih barang:</label>
							<select name="barang" class="form-control">
								<?php foreach ($barang as $ktg) : ?>
									<option value="<?= $ktg->id; ?>" <?= $ktg->id == $dt->barang ? 'selected' : '' ?>><?= $ktg->nama; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Jumlah barang:</label>
							<input type="number" class="form-control" name="jumlah" value="<?= $dt->jumlah ?>">
						</div>

						<input type="submit" name="simpan" class="btn btn-success btn-rounded" value="simpan">
					</form>
				</div>
			</div>
			<!-- ------------( Batas Akhir Isi Halaman )------------ -->
		</div>
		<!-- /.container-fluid -->

	</div>

	<?php include 'part/footer.php' ?>
	<?php include 'part/modal.php' ?>

	<?php include 'part/js.php' ?>
</body>

</html>