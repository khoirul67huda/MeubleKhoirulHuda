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

			<button data-toggle="collapse" data-target="#buyer" class="btn btn-success btn-sm my-1"><i class="fas fa-plus"></i> Tambah Buyer</button>
			
			<div id="buyer" class="collapse">
				
				<div class="card shadow mb-1">
					<div class="card-header alert-info">
						Tambah Buyer
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
	
							<div class="form-group">
								<label>Kode Buyer:</label>
								<input type="text" class="form-control" name="kode_buyer" placeholder="Ketik Kode Buyer">
							</div>
							<div class="form-group">
								<label>Nama Buyer:</label>
								<input type="text" class="form-control" name="nama_buyer" placeholder="Ketik Nama Buyer">
							</div>
							<div class="form-group">
								<label>Email Buyer:</label>
								<input type="text" class="form-control" name="email_buyer" placeholder="Ketik Email Buyer">
							</div>
	
							<input type="submit" name="simpan" class="btn btn-success btn-rounded" value="simpan">
						</form>
					</div>
				</div>
			</div>
			
			
			<div class="card shadow mb-4">
				<div class="card-header py-3">

					<h2 class="h5 mb-0 text-gray-800">List Buyer</h2>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Kode Buyer</th>
									<th>Nama Buyer</th>
									<th>Email</th>
									<th>aksi</th>

								</tr>
							</thead>

							<tbody>
								<?php
								foreach ($data as $dt) : ?>
									<tr>
										<td><?= $dt->kode_buyer?></td>
										<td><?= $dt->nama_buyer ?></td>
										<td><?= $dt->email_buyer ?></td>
										
										<td>
											<a href="<?= base_url('admin/edit_buyer/') . $dt->kode_buyer ?>" class="btn btn-secondary rounded-circle btn-sm"><i class="fas fa-edit"></i></a>
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