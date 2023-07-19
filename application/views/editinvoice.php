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

			<a href="<?= base_url('admin/invoice') ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
			<div class="card shadow mb-1">
				<div class="card-header">
					<h4><?= $dt->kode_buyer . '-' . $dt->kode_po ?></h4>
				</div>
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name='total_item' value="<?= $dt->total_item ?>">
						<input type="hidden" name='kode_po' value="<?= $dt->kode_po ?>">

						<div class="form-group">
							<label>pilih buyer:</label>
							<select name="kode_buyer" class="form-control">
								<?php foreach ($buyer as $byr) : ?>
									<option value="<?= $byr->kode_buyer; ?>" <?= $byr->kode_buyer == $dt->kode_buyer ? 'selected' : '' ?>><?= $byr->kode_buyer . ' ' . $byr->nama_buyer; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group">
							<label>Alamat Export:</label>
							<input type="text" class="form-control" name="alamat_export" placeholder="Tulis Alamat Tujuan Export" value="<?= $dt->alamat_export ?>">
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