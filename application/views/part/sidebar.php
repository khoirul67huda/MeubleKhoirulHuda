	<!-- Page Wrapper -->
	<div id="wrapper">


		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
				<div class="sidebar-brand-icon mx-3">Putra Meuble</div>

			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item <?= $page == 'dashboard' ? "active" : "" ?>">
				<a class="nav-link" href="<?= base_url('admin') ?>">
					<i class="fas fa-chart-bar"></i>
					<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Heading -->
			<div class="sidebar-heading">
				Overview
			</div>
			<?php if ($this->session->userdata('mkh_logged')->role != '4') : ?>
				<li class="nav-item" <?= $page == 'deadline' ? "active" : "" ?>>
					<a class="nav-link py-1" href="<?= base_url('admin/deadline') ?>">
						<i class="fas fa-clock"></i>
						<span>Item Deadline</span></a>
				</li>
				<li class="nav-item  <?= $page == 'supplier' ? "active" : "" ?>">
					<a class="nav-link py-1" href="<?= base_url('admin/supplier') ?>">
						<i class="fas fa-tasks"></i>
						<span>Order By Supplier</span></a>
				</li>
			<?php endif; ?>
			<li class="nav-item <?= $page == 'invoice' ? "active" : "" ?>">
				<a class=" nav-link pt-1" href="<?= base_url('admin/invoice') ?>">
					<i class="fas fa-file-invoice"></i>
					<span> Order by Invoice</span></a>
			</li>
			<hr class="sidebar-divider">
			<!-- Heading -->
			<?php if ($this->session->userdata('mkh_logged')->role == '1' || $this->session->userdata('mkh_logged')->role == '3') : ?>
				<div class="sidebar-heading">
					Daftar
				</div>
				<li class="nav-item  <?= $page == 'barang' ? "active" : "" ?>">
					<a class="nav-link" href="<?= base_url('admin/barang') ?>">
						<i class="fas fa-chart-bar"></i>
						<span>Barang</span></a>
				</li>
				<li class="nav-item  <?= $page == 'buyer' ? "active" : "" ?>">
					<a class="nav-link pt-0" href="<?= base_url('admin/buyer') ?>">
						<i class="fas fa-user"></i>
						<span>Buyer</span></a>
				</li>
			<?php endif; ?>

			<?php if ($this->session->userdata('mkh_logged')->role == '1') : ?>
				<hr class="sidebar-divider my-0">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('admin/users') ?>">
						<i class="fas fa-users"></i>
						<span> Kontrol Akun</span></a>
				</li>

			<?php endif; ?>
			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">