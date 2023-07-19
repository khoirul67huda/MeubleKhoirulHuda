<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MoBarang');
		$this->load->model('MoUser');
		$this->load->model('MoInvoice');
		$this->load->model('MoSupplier');
		$this->load->model('MoProduksi');
		$this->load->library('form_validation');
		if ($this->MoUser->isNotLogin()) redirect(site_url('user/login'));
	}

	public function index()
	{
		if (isset($_POST['ubah_password'])) {
			if ($this->input->post('password') == $this->input->post('cpassword')) {
				$this->MoUser->ubah_password();
			}
		}

		$data['page'] = "dashboard";
		$this->load->view('dashboard', $data);
	}
	//----------------------------------
	public function deadline()
	{
		if ($this->session->userdata('mkh_logged')->role == 4) {
			redirect(base_url('admin'));
		}

		$data['page'] = 'deadline';
		$data['data'] = $this->MoProduksi->getSupplier();


		$this->load->view('deadline', $data);
	}
	public function chat($id)
	{
		if ($this->session->userdata('mkh_logged')->role == 4) {
			redirect(base_url('admin'));
		}

		if (isset($_POST["komentar"])) {
			$this->MoProduksi->saveKomentar();
			redirect(site_url('admin/chat/' . $id));
		}

		$data['page'] = 'deadline';
		$data['data'] = $this->MoProduksi->getChat($id);
		$data['barang'] = $this->MoProduksi->statusChat($id)[0];
		$this->load->view('chat', $data);
	}
	//----------------------------------
	public function supplier()
	{
		if ($this->session->userdata('mkh_logged')->role == 4) {
			redirect(base_url('admin'));
		}
		if (isset($_POST["simpan"])) {
			$this->MoSupplier->savesupplier();
			redirect(site_url('admin/supplier'));
		}

		$data['page'] = 'supplier';
		$data['data'] = $this->MoProduksi->getSupplier();


		$this->load->view('supplier', $data);
	}

	public function edit_supplier($kode_sup)
	{
		if (isset($_POST["simpan"])) {
			$this->MoSupplier->updatesupplier();
			$id = $this->input->post('kode_sup');
			redirect(base_url('admin/edit_supplier/' . $id));
		}
		$data['page'] = 'supplier';
		$data['dt'] = $this->MoSupplier->getByIdsupplier($kode_sup);
		$this->load->view('editsupplier', $data);
	}

	public function delete_supplier($kode_sup = null)
	{
		if (!isset($kode_sup)) show_404();

		if ($this->MoSupplier->deleteSupplier($kode_sup)) {
			redirect(site_url('admin/supplier'));
		}
	}
	public function order_supplier($id)
	{
		$data['page'] = 'supplier';
		$data['sup'] =  $this->MoSupplier->getByIdsupplier($id);
		$data['data'] = $this->MoProduksi->getOrderSupplier($id);
		$this->load->view('ordersupplier', $data);
	}


	public function produksi_supplier($sup, $buyer, $po)
	{
		$data['kobuyer'] = $buyer;
		$data['kopo'] = $po;
		$data['page'] = 'supplier';
		$data['sup'] =  $this->MoSupplier->getByIdsupplier($sup);
		$data['data'] = $this->MoProduksi->produksiSupplier($sup, $buyer, $po);
		$data['buyer'] = $this->MoInvoice->getByIdBuyer($buyer);

		$this->load->view('produksisupplier', $data);
	}

	public function produksi_selesai()
	{
		$post = $this->input->post();
		$sup = $post['sup'];
		$buyer = $post['buyer'];
		$po = $post['po'];
		$this->MoProduksi->updateProduksiSelesai();
		redirect(site_url('admin/produksi_supplier/' . $sup . '/' . $buyer . '/' . $po));
	}
	//----------------------------------
	public function invoice()
	{
		if (isset($_POST["simpan"])) {
			$this->MoInvoice->save();
			redirect(site_url('admin/invoice'));
		}

		$data['page'] = 'invoice';
		$data['data'] = $this->MoInvoice->getAll();
		$data['barang'] = $this->MoBarang->getAll();
		$data['buyer'] = $this->MoInvoice->getBuyer();

		$this->load->view('invoice', $data);
	}
	public function invoice_po($id)
	{
		if (isset($_POST["simpan"])) {
			$this->MoInvoice->savePO();
			$this->MoInvoice->updateTotalItemTransaksi();
			redirect(site_url('admin/invoice_po/' . $id));
		}

		$data['page'] = 'invoice';
		$data['data'] = $this->MoInvoice->getPO($id);
		$data['kode'] = $this->MoInvoice->getTransaksi($id);
		$data['barang'] = $this->MoBarang->getAll();
		$data['buyer'] = $this->MoInvoice->getBuyer();

		$this->load->view('invoice_po', $data);
	}

	public function edit_invoice_barang($id)
	{
		if (isset($_POST["simpan"])) {
			$this->MoInvoice->update();
		}
		$data['page'] = 'invoice';
		$data['dt'] = $this->MoInvoice->getById($id)[0];
		$data['barang'] = $this->MoBarang->getAll();
		$data['buyer'] = $this->MoInvoice->getBuyer();
		$this->load->view('editinvoicebarang', $data);
	}
	public function edit_invoice($id)
	{
		if (isset($_POST["simpan"])) {
			$this->MoInvoice->update_invoice();
		}
		$data['page'] = 'invoice';
		$data['dt'] = $this->MoInvoice->getTransaksi($id);
		$data['barang'] = $this->MoBarang->getAll();
		$data['buyer'] = $this->MoInvoice->getBuyer();
		$this->load->view('editinvoice', $data);
	}

	public function detail_invoice($id, $barang = null)
	{
		if (isset($_POST["pembagian"])) {
			$this->MoProduksi->save();
			$this->MoInvoice->proses_produksi();
		}
		$data['page'] = 'invoice';
		$dt = $this->MoInvoice->getById($id)[0];
		$data['dt'] = $dt;
		$data['barang'] = $this->MoBarang->getAll();
		$data['list_sup'] = $this->MoProduksi->getByKodePO($dt->kode_po, $dt->id_barang);
		$data['supplier'] = $this->MoSupplier->getsupplier();
		$data['idnya'] = $id;
		if (!isset($barang)) {
			$this->load->view('detailinvoice', $data);
		}
		if (isset($barang)) {
			$data['back'] = 'admin/detail_invoice/' . $id;
			$data['data'] = $this->MoBarang->getById($barang)[0];
			$data['kategori'] = $this->MoBarang->getkategori();
			$this->load->view('detailbarang', $data);
		}
	}



	public function delete_invoice($id = null, $kode_po = null, $total_item = null, $id_barang = null)
	{
		if (!isset($id)) show_404();

		if ($this->MoInvoice->delete($id)) {
			$this->MoInvoice->kurangiTotalItemTransaksi($kode_po, $total_item);
			$this->MoProduksi->delete($kode_po, $id_barang);
			redirect(site_url('admin/invoice_po/' . $kode_po));
		}
	}
	//----------------------------------
	public function barang()
	{
		if ($this->session->userdata('mkh_logged')->role != 1 && $this->session->userdata('mkh_logged')->role != 3) {
			redirect(base_url('admin'));
		}
		if (isset($_POST["simpan"])) {
			$this->MoBarang->save();
			redirect(site_url('admin/barang'));
		}
		if (isset($_POST["simpan-kategori"])) {
			$this->MoBarang->savekategori();
			redirect(site_url('admin/barang'));
		}
		if (isset($_POST["edit-kategori"])) {
			$this->MoBarang->updatekategori();
			redirect(site_url('admin/barang'));
		}
		$data['page'] = 'barang';
		$data['data'] = $this->MoBarang->getAll();
		$data['kategori'] = $this->MoBarang->getkategori();

		$this->load->view('barang', $data);
	}

	public function detail_barang($id)
	{
		$data['page'] = 'barang';
		$data['back'] = 'admin/barang/';
		$data['data'] = $this->MoBarang->getById($id)[0];
		$data['kategori'] = $this->MoBarang->getkategori();
		$this->load->view('detailbarang', $data);
	}
	public function edit_barang($id)
	{
		if (isset($_POST["simpan"])) {
			$this->MoBarang->update();
		}
		$data['page'] = 'barang';
		$data['dt'] = $this->MoBarang->getById($id)[0];
		$data['kategori'] = $this->MoBarang->getkategori();
		$this->load->view('editbarang', $data);
	}

	public function delete_barang($id = null)
	{
		if (!isset($id)) show_404();

		if ($this->MoBarang->delete($id)) {
			redirect(site_url('admin/barang'));
		}
	}

	// ----------------------------------

	public function buyer()
	{
		if ($this->session->userdata('mkh_logged')->role != 1 && $this->session->userdata('mkh_logged')->role != 3) {
			redirect(base_url('admin'));
		}
		if (isset($_POST["simpan"])) {
			$this->MoInvoice->saveBuyer();
			$this->MoInvoice->buatAkunBuyer();
			redirect(site_url('admin/buyer'));
		}

		$data['page'] = 'buyer';
		$data['data'] = $this->MoInvoice->getBuyer();


		$this->load->view('buyer', $data);
	}

	public function edit_buyer($kode_buyer)
	{
		if (isset($_POST["simpan"])) {
			$this->MoInvoice->updateBuyer();
			$this->MoInvoice->UpdateAkunBuyer();
			$id = $this->input->post('kode_buyer');
			redirect(base_url('admin/edit_buyer/' . $id));
		}
		$data['page'] = 'buyer';
		$data['dt'] = $this->MoInvoice->getByIdBuyer($kode_buyer);
		$this->load->view('editbuyer', $data);
	}
	// --------------------------------------

	public function users()
	{
		if ($this->session->userdata('mkh_logged')->role != 1) {
			redirect(base_url('admin'));
		}
		if (isset($_POST["simpan"])) {
			$this->MoUser->save();
			redirect(site_url('admin/users'));
		}
		$data['page'] = 'users';
		$data['data'] = $this->MoUser->getAll();

		$this->load->view('users', $data);
	}

	public function delete_users($id = null)
	{
		if (!isset($id)) show_404();

		if ($this->MoUser->delete($id)) {
			redirect(site_url('admin/users'));
		}
	}

	public function reset_password($id = null)
	{
		if (!isset($id)) show_404();

		if ($this->MoUser->reset_password($id)) {
			redirect(site_url('admin/users'));
		}
	}
}
