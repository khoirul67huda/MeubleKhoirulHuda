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

			<button data-toggle="collapse" data-target="#barang" class="btn btn-success btn-sm my-1"><i class="fas fa-plus"></i> Tambah Barang</button>
			<button data-toggle="collapse" data-target="#kategori" class="btn btn-success btn-sm my-1"><i class="fas fa-plus"></i> Tambah Kategori</button>
			<button data-toggle="collapse" data-target="#listkategori" class="btn btn-success btn-sm my-1"><i class="fas fa-edit"></i> Edit Kategori</button>

			<div id="barang" class="collapse">
				<div class="card shadow mb-1">
					<div class="card-header alert-success">
						Tambah Barang
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>kode:</label>
								<input type="text" class="form-control" name="kode" placeholder="ketik kode barang">
							</div>
							<div class="form-group">
								<label>kategori:</label>
								<select name="kategori" class="form-control">
									<?php foreach ($kategori as $ktg) : ?>
										<option value="<?= $ktg->id; ?>"><?= $ktg->kategori; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Nama:</label>
								<input type="text" class="form-control" name="nama" placeholder="ketik nama barang">
							</div>
							<div class="form-group">
								<label>deskripsi:</label>
								<input type="text" class="form-control" name="deskripsi" placeholder="ketik deskripsi barang">
							</div>
							<div class="form-group">
								<label>warna:</label>
								<input type="text" class="form-control" name="warna" placeholder="ketik warna barang">
							</div>
							<div class="row">

								<div class="form-group col-lg-3">
									<label>baud:</label>
									<input type="text" class="form-control" name="baud" placeholder="ketik Hexa/jcbc M8/m6 ...cm">
								</div>
								<div class="form-group col-lg-3">
									<label>skrup:</label>
									<input type="text" class="form-control" name="skrup" placeholder="ketik FAB/PAB M4 ...cm">
								</div>
								<div class="form-group col-lg-3">
									<label>adjuster:</label>
									<input type="text" class="form-control" name="adjuster" placeholder="ketik M8X25/M8X32/M10X50">
								</div>
								<div class="form-group col-lg-3">
									<label>hangtag:</label>
									<input type="text" class="form-control" name="hangtag">
								</div>
							</div>
							<div class="form-group">
								<label>Link drawing:</label>
								<input type="text" class="form-control" name="drawing">
							</div>
							<div class="form-group">
								<label>harga:</label>
								<input type="text" class="form-control" name="harga" placeholder="ketik harga barang">
							</div>
							<div class="form-group">
								<label>Foto:</label>
								<input type="file" name="foto" class="form-control">
							</div>
							<input type="submit" name="simpan" class="btn btn-success btn-rounded" value="simpan">
						</form>
					</div>
				</div>
			</div>
			<div id="kategori" class="collapse">
				<div class="card shadow mb-1">
					<div class="card-header alert-info">
						Tambah Kategori
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">

							<div class="form-group">
								<label>kategori:</label>
								<input type="text" class="form-control" name="kategori" placeholder="ketik kategori barang">
							</div>

							<input type="submit" name="simpan-kategori" class="btn btn-success btn-rounded" value="simpan">
						</form>
					</div>
				</div>
			</div>
			<div id="listkategori" class="collapse">
				<div class="card shadow mb-1">
					<div class="card-header alert-warning">
						Edit Kategori
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">

							<div class="form-group">
								<label>kategori Lama:</label>
								<select name="id" class="form-control">
									<?php foreach ($kategori as $ktg) : ?>
										<option value="<?= $ktg->id; ?>"><?= $ktg->kategori; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>kategori Baru:</label>
								<input type="text" class="form-control" name="kategori" placeholder="ketik kategori barang">
							</div>

							<input type="submit" name="edit-kategori" class="btn btn-success btn-rounded" value="simpan">
						</form>
					</div>
				</div>
			</div>
			<div class="card shadow mb-4">
				<div class="card-header py-3">

					<h2 class="h5 mb-0 text-gray-800">List Barang</h2>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>NO</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>Foto</th>
									<th>aksi</th>

								</tr>
							</thead>

							<tbody>
								<?php $i = 1;
								foreach ($data as $dt) : ?>
									<tr>
										<td><?= $i++ ?></td>
										<td><?= $dt->kode ?></td>
										<td><?= $dt->nama ?></td>
										<td><img src="<?= base_url('assets/img/') . $dt->foto ?>" alt="" width="200px"></td>
										<td>
											<a href="<?= base_url('admin/detail_barang/') . $dt->id ?>" class="btn btn-warning rounded-circle btn-sm"><i class="fas fa-search"></i></a>
											<a href="<?= base_url('admin/edit_barang/') . $dt->id ?>" class="btn btn-secondary rounded-circle btn-sm"><i class="fas fa-edit"></i></a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/delete_barang/' . $dt->id) ?>')" href="#!" class="btn btn-danger rounded-circle btn-sm"><i class="fas fa-trash"></i></a>

										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- ------------( Batas Akhir Isi Halaman )------------ -->
		</div>
		<!-- /.container-fluid -->

	</div>

	<?php include 'part/footer.php' ?>
	<?php include 'part/modal.php' ?>
	<script>
		function deleteConfirm(url) {
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>
	<?php include 'part/js.php' ?>
</body>

</html>