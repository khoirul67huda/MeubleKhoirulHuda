<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MoBarang extends CI_Model
{
    private $_table = 'barang';
    private $tbkategori = 'kategoribarang';

    public function getAll($idkategori = null)
    {
        if ($idkategori != null && $idkategori != 'semua') {
            $query = $this->db->query("SELECT * FROM `barang` WHERE kategori = '$idkategori' ORDER BY id desc;");
        } else {
            $query = $this->db->query("SELECT * FROM `barang` ORDER BY id desc;");
        }
        return $query->result();
    }
    public function getkategori()
    {
        $this->db->from($this->tbkategori);
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $query = $this->db->query("SELECT b.*,k.kategori as nama_kategori FROM `barang` as b JOIN kategoribarang as k on b.kategori = k.id WHERE b.id = '$id';");
        return $query->result();
    }

    public function savekategori()
    {
        $post = $this->input->post();

        $this->kategori = $post['kategori'];

        return $this->db->insert($this->tbkategori, $this);
    }

    public function updatekategori()
    {
        $post = $this->input->post();

        $this->id = $post['id'];
        $this->kategori = $post['kategori'];

        return $this->db->update($this->tbkategori, $this, array('id' => $post['id']));
    }
    public function save()
    {
        $post = $this->input->post();
        $this->kode = $post['kode'];
        $this->kategori = $post['kategori'];
        $this->nama = $post['nama'];
        $this->deskripsi = $post['deskripsi'];
        $this->warna = $post['warna'];
        $this->baud = $post['baud'];
        $this->skrup = $post['skrup'];
        $this->adjuster = $post['adjuster'];
        $this->hangtag = $post['hangtag'];
        $this->drawing = $post['drawing'];
        $this->harga = $post['harga'];
        if (!empty($_FILES['foto']['tmp_name'])) {
            $this->foto = $this->_uploadImage();
        } else {
            $this->foto = 'kosongan.png';
        }
        return $this->db->insert($this->_table, $this);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->id = $post['id'];
        $this->kode = $post['kode'];
        $this->kategori = $post['kategori'];
        $this->nama = $post['nama'];
        $this->deskripsi = $post['deskripsi'];
        $this->warna = $post['warna'];
        $this->baud = $post['baud'];
        $this->skrup = $post['skrup'];
        $this->adjuster = $post['adjuster'];
        $this->hangtag = $post['hangtag'];
        $this->drawing = $post['drawing'];
        $this->harga = $post['harga'];
        if (!empty($_FILES['foto']['tmp_name'])) {
            if ($post["old"] != 'kosongan.png') unlink('assets/img/' . $post["old"]);
            $this->foto = $this->_uploadImage();
        } else {
            $this->foto = $post['old'];
        }
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, array("id" => $id));
    }

    private function _deleteImage($id)
    {
        $gambar = $this->getById($id);
        if ($gambar->foto != "kosongan.png" && $gambar->foto != '') {
            $filename = explode(".", $gambar->foto)[0];
            return array_map('unlink', glob(FCPATH . "assets/img/$filename.*"));
        }
    }

    private function _uploadImage()
    {
        $config['upload_path'] = "assets/img";
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name'] = $this->kategori . time();
        $config['overwrite'] = true;
        $config['max_size'] = 5048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        } else {
            return "kosongan.png";
        }
    }
}
