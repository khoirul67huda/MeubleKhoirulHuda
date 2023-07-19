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

			<a href="<?= base_url('admin/barang') ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
			<div class="card shadow mb-1">
				<div class="card-header">
					<h4>Detail <?= $dt->nama ?></h4>
				</div>
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name='id' value="<?= $dt->id ?>">
						<input type="hidden" name='old' value="<?= $dt->foto ?>">
						<div class="form-group">
							<label>kode:</label>
							<input type="text" class="form-control" name="kode" value="<?= $dt->kode ?>">
						</div>
						<div class="form-group">
							<label>kategori:</label>
							<select name="kategori" class="form-control">
								<?php foreach ($kategori as $ktg) : ?>
									<option value="<?= $ktg->id; ?>" <?= $ktg->id == $dt->kategori ? 'selected' : '' ?>><?= $ktg->kategori; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Nama:</label>
							<input type="text" class="form-control" name="nama" value="<?= $dt->nama ?>">
						</div>
						<div class="form-group">
							<label>deskripsi:</label>
							<textarea name="deskripsi" class="form-control"><?= $dt->deskripsi ?></textarea>
						</div>
						<div class="form-group">
							<label>warna:</label>
							<input type="text" class="form-control" name="warna" value="<?= $dt->warna ?>">
						</div>
						<div class="row">

							<div class="form-group col-lg-3">
								<label>baud:</label>
								<input type="text" class="form-control" name="baud" value="<?= $dt->baud ?>">
							</div>
							<div class="form-group col-lg-3">
								<label>skrup:</label>
								<input type="text" class="form-control" name="skrup" value="<?= $dt->skrup ?>">
							</div>
							<div class="form-group col-lg-3">
								<label>adjuster:</label>
								<input type="text" class="form-control" name="adjuster" value="<?= $dt->adjuster ?>">
							</div>
							<div class="form-group col-lg-3">
								<label>hangtag:</label>
								<input type="text" class="form-control" name="hangtag" value="<?= $dt->hangtag ?>">
							</div>
						</div>
						<div class="form-group">
							<label>Link drawing:</label>
							<input type="text" class="form-control" name="drawing" value="<?= $dt->drawing ?>">
						</div>
						<div class="form-group">
							<label>harga:</label>
							<input type="text" class="form-control" name="harga" value="<?= $dt->harga ?>">
						</div>
						<div class="form-group">
							<label>Foto:</label>
							<input type="file" class="form-control" name="foto">
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