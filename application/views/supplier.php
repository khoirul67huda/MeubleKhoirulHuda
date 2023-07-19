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

			<button data-toggle="collapse" data-target="#supplier" class="btn btn-success btn-sm my-1"><i class="fas fa-plus"></i> Tambah supplier</button>

			<div id="supplier" class="collapse">

				<div class="card shadow mb-1">
					<div class="card-header alert-info">
						Tambah supplier
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">

							<div class="form-group">
								<label>Kode supplier:</label>
								<input type="text" class="form-control" name="kode_sup" placeholder="Ketik Kode supplier">
							</div>
							<div class="form-group">
								<label>Nama supplier:</label>
								<input type="text" class="form-control" name="nama_sup" placeholder="Ketik Nama supplier">
							</div>
							<div class="form-group">
								<label>Alamat supplier:</label>
								<input type="text" class="form-control" name="alamat_sup" placeholder="Ketik alamat supplier">
							</div>

							<input type="submit" name="simpan" class="btn btn-success btn-rounded" value="simpan">
						</form>
					</div>
				</div>
			</div>


			<div class="card shadow mb-4">
				<div class="card-header py-3">

					<h2 class="h5 mb-0 text-gray-800">List supplier</h2>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Kode supplier</th>
									<th>Nama supplier</th>
									<th>Alamat</th>
									<th>Total PO</th>
									<th>aksi</th>

								</tr>
							</thead>

							<tbody>
								<?php
								foreach ($data as $dt) : ?>
									<tr>
										<td><?= $dt->kode_sup ?></td>
										<td><?= $dt->nama_sup ?></td>
										<td><?= $dt->alamat_sup ?></td>
										<td><?= $dt->produksi ?></td>

										<td>
											<a href="<?= base_url('admin/order_supplier/' . $dt->kode_sup) ?>" class="btn btn-warning rounded-circle btn-sm"><i class="fas fa-arrow-right"></i></a>
											<a href="<?= base_url('admin/edit_supplier/') . $dt->kode_sup ?>" class="btn btn-secondary rounded-circle btn-sm"><i class="fas fa-edit"></i></a>
											<a onclick="deleteConfirm('<?php echo site_url('admin/delete_supplier/' . $dt->kode_sup) ?>')" href="#!" class="btn btn-danger rounded-circle btn-sm"><i class="fas fa-trash"></i></a>
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