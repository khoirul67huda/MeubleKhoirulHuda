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
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Selamat Datang <?= $this->session->userdata('mkh_logged')->nama ?></h1>
				<?php if ($this->session->userdata('mkh_logged')->role != 4) : ?>
					<button data-toggle="collapse" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-target="#demo"><i class="fas fa-user-cog fa-sm text-white-50"></i> Setting Account</button>
				<?php endif; ?>
			</div>
			<div id="demo" class="<?= $this->session->userdata('mkh_logged')->role != 4 ? 'collapse' : ''; ?>">
				<div class="row">
					<div class="col">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Profil</h6>
							</div>
							<div class="card-body">
								<Table width="100%">
									<form action="" method="post">
										<tr>
											<td>ID</td>
											<td>:</td>
											<td><input type="text" class="form-control" name="username" value="<?= $this->session->userdata('mkh_logged')->username ?>" disabled></td>
										</tr>
										<?php
										switch ($this->session->userdata('mkh_logged')->role) {
											case "1":
												$role = "Super Admin";
												break;
											case "2":
												$role = "Admin Gudang";
												break;
											case "3":
												$role = "PPIC";
												break;
											case "4":
												$role = "Pengunjung";
												break;
										}
										?>
										<tr>
											<td>Role</td>
											<td>:</td>
											<td><input type="text" class="form-control" name="role" value="<?= $role ?>" disabled></td>
										</tr>
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td><input type="text" class="form-control" name="nama" value="<?= $this->session->userdata('mkh_logged')->nama ?>" disabled></td>
										</tr>
										<!-- <tr>
											<td></td>
											<td></td>
											<td><input type="submit" class="btn btn-success" name="simpan_profil" value="Save"></td>
										</tr> -->

									</form>
								</Table>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
							</div>
							<div class="card-body">
								<Table width="100%">
									<form action="" method="post">
										<input type="hidden" name="id" value="<?= $this->session->userdata('mkh_logged')->id ?>">
										<tr>
											<td>Password Baru</td>
											<td>:</td>
											<td><input type="password" class="form-control" name="password" placeholder="Ketik password baru"></td>
										</tr>
										<tr>
											<td>Ulangi Password</td>
											<td>:</td>
											<td><input type="password" class="form-control" name="cpassword" placeholder="Ketik ulang password baru"></td>
										</tr>

										<tr>
											<td></td>
											<td></td>
											<td><input type="submit" class="btn btn-success" name="ubah_password" value="Save"></td>
										</tr>

									</form>
								</Table>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
			<!-- <div class="row">
				<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-danger shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
										ITEM DEADLINE</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">120</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-bell fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-success shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
										ORDER by SUPPLIER</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">120</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-tasks fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6 mb-4">
					<div class="card border-left-primary shadow h-100 py-2">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
										TOTAL ITEM</div>
									<div class="h5 mb-0 font-weight-bold text-primary-800">120</div>
								</div>
								<div class="col-auto">
									<i class="fas fa-file-invoice fa-2x text-gray-300"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<?php if ($this->session->userdata('mkh_logged')->role != '4') : ?>
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Diagram Produksi Supplier</h6>
					</div>

					<div class="card-body">
						<div class="chart-bar">
							<canvas id="supplierChart"></canvas>
						</div>

					</div>
				</div>
			<?php endif; ?>
			<!-- ------------( Batas Akhir Isi Halaman )------------ -->
		</div>
		<!-- /.container-fluid -->

	</div>

	<?php include 'part/footer.php' ?>
	<?php include 'part/modal.php' ?>

	<?php include 'part/js.php' ?>
	<?php include 'part/chartsupplier.php' ?>
</body>

</html>