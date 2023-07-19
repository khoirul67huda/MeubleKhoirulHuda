<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MoBarang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['page'] = "dashboard";

        $data['gambar'] = $this->MoBarang->getAll();

        $this->load->view('katalog', $data);
    }
    public function produk($idkategori = null)
    {
        if (!isset($idkategori)) {
            $idkategori = '';
        }

        $data['page'] = "dashboard";

        $kategori = $this->MoBarang->getkategori();
        $data['kategori'] = $kategori;

        $kategorine = '';

        foreach ($kategori as $ktg) {
            if ($idkategori == $ktg->id) {
                $kategorine = $ktg->kategori;
            }
        }

        $data['idk'] = $idkategori;
        $data['kategorine'] = $kategorine;
        $data['gambar'] = $this->MoBarang->getAll($idkategori);
        $this->load->view('produk', $data);
    }

    public function detail_produk($id)
    {
        $kategori = $this->MoBarang->getkategori();
        $dt = $this->MoBarang->getById($id)[0];
        $data['dt'] = $dt;
        foreach ($kategori as $ktg) {
            if ($dt->kategori == $ktg->id) {
                $data['kategori'] = $ktg->kategori;
            }
        }
        $this->load->view('detailproduk', $data);
    }

    public function contact()
    {
        $this->load->view('contact');
    }
}
