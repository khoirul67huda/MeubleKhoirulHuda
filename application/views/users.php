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

			<button data-toggle="collapse" data-target="#barang" class="btn btn-success btn-sm my-1"><i class="fas fa-plus"></i> Tambah Admin</button>

			<div id="barang" class="collapse">
				<div class="card shadow mb-1">
					<div class="card-header">
						Tambah Akun
					</div>
					<div class="card-body">
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Nama:</label>
								<input type="text" class="form-control" name="nama" placeholder="Nama Pemilik Akun">
							</div>
							<div class="form-group">
								<label>ID:</label>
								<input type="text" class="form-control" name="username" placeholder="ID / username untuk Login">
							</div>
							<div class="form-group">
								<label>Password:</label>
								<input type="text" class="form-control" name="password" placeholder="Password untuk login">
							</div>
							<div class="form-group">
								<label>Role:</label>
								<br>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="role" value="1">Super Admin
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="role" value="2">Admin Gudang
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="role" value="3">PPIC
									</label>
								</div>
								
							</div>

							<input type="submit" name="simpan" class="btn btn-success btn-rounded" value="simpan">
						</form>
					</div>
				</div>
			</div>

			<div class="card shadow mb-4">
				<div class="card-header py-3">

					<h2 class="h5 mb-0 text-gray-800">List Users</h2>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>NO</th>
									<th>Nama</th>
									<th>Role</th>
									<th>aksi</th>

								</tr>
							</thead>

							<tbody>
								<?php $i = 1;
								foreach ($data as $dt) : ?>
									<tr class="<?php
												switch ($dt->role) {
													case "1":
														echo "table-success";
														break;
													case "2":
														echo "table-secondary";
														break;
													case "3":
														echo "table-warning";
														break;
												}
												?>">
										<td><?= $i++ ?></td>
										<td><?= $dt->nama ?></td>
										<td>
											<?php
											switch ($dt->role) {
												case "1":
													echo "Super Admin";
													break;
												case "2":
													echo "Admin Gudang";
													break;
												case "3":
													echo "PPIC";
													break;
												case "4":
													echo "Pengunjung";
													break;
											}
											?>
										</td>
										<td>

											<a onclick="resetConfirm('<?php echo site_url('admin/reset_password/' . $dt->id) ?>')" href="#!" class="btn btn-secondary rounded-circle btn-sm"><i class="fas fa-edit"></i></a>
											<?php if ($dt->role != 1 && $dt->role != 4) : ?>
												<a onclick="deleteConfirm('<?php echo site_url('admin/delete_users/' . $dt->id) ?>')" href="#!" class="btn btn-danger rounded-circle btn-sm"><i class="fas fa-trash"></i></a>
											<?php endif; ?>

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
		function resetConfirm(url) {
			$('#btn-reset').attr('href', url);
			$('#resetModal').modal();
		}

		function deleteConfirm(url) {
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}
	</script>
	<?php include 'part/js.php' ?>
</body>

</html>