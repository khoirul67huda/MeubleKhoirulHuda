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

			<a href="<?= base_url('admin/supplier') ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
			<div class="card shadow mb-1">
				<div class="card-header">
					<h4>Detail <?= $dt->kode_sup ?></h4>
				</div>
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="kode_lama" value="<?= $dt->kode_sup ?>">
						<div class="form-group">
							<label>kode:</label>
							<input type="text" class="form-control" name="kode_sup" value="<?= $dt->kode_sup ?>">
						</div>

						<div class="form-group">
							<label>Nama:</label>
							<input type="text" class="form-control" name="nama_sup" value="<?= $dt->nama_sup ?>">

							<div class="form-group">
								<label>Alamat:</label>
								<input type="text" class="form-control" name="alamat_sup" value="<?= $dt->alamat_sup ?>">
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