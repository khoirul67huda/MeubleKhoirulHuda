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

			<a href="<?= base_url($back) ?>" class="btn btn-secondary mb-1 ml-1"><i class="fas fa-arrow-left"></i> Kembali</a>
			<div class="card shadow mb-1">
				<div class="card-header">
					<h4>Detail <?= $data->nama ?></h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-4">
							<img src="<?= base_url() ?>assets/img/<?= $data->foto ?>" class="rounded img-fluid">
						</div>
						<div class="col-lg-8">
							<table width="100%">
								<tr>
									<td>Kode</td>
									<td>:</td>
									<td><?= $data->kode ?></td>
								</tr>
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><?= $data->nama ?></td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>:</td>
									<td><?= $data->nama_kategori ?></td>
								</tr>
								<tr>
									<td>deskripsi</td>
									<td>:</td>
									<td><?= $data->deskripsi ?></td>
								</tr>
								<tr>
									<td>warna</td>
									<td>:</td>
									<td><?= $data->warna ?></td>
								</tr>
								<tr>
									<td>baud</td>
									<td>:</td>
									<td><?= $data->baud ?></td>
								</tr>
								<tr>
									<td>skrup</td>
									<td>:</td>
									<td><?= $data->skrup ?></td>
								</tr>
								<tr>
									<td>adjuster</td>
									<td>:</td>
									<td><?= $data->adjuster ?></td>
								</tr>
								<tr>
									<td>hangtag</td>
									<td>:</td>
									<td><?= $data->hangtag ?></td>
								</tr>
								<tr>
									<td>link drawing</td>
									<td>:</td>
									<td><a href="<?= $data->drawing ?>"><?= $data->drawing ?></a></td>
								</tr>
								<tr>
									<td>harga</td>
									<td>:</td>
									<td><?= $data->harga ?></td>
								</tr>
							</table>
						</div>
					</div>
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