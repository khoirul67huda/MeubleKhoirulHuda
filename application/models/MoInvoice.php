<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MoInvoice extends CI_Model
{
    private $_table = 'invoice';
    private $tbbuyer = 'buyer';
    private $tbtransaksi = 'transaksi';

    public function getAll()
    {
        if ($this->session->userdata('mkh_logged')->role == 4) {
            $kode_buyer = $this->session->userdata('mkh_logged')->username;
            $query = $this->db->query("SELECT t.*,bu.* FROM `transaksi` as t JOIN buyer as bu on t.kode_buyer = bu.kode_buyer WHERE t.kode_buyer = '$kode_buyer'");
        } else {
            $query = $this->db->query("SELECT t.*,bu.* FROM `transaksi` as t JOIN buyer as bu on t.kode_buyer = bu.kode_buyer");
        }
        return $query->result();
    }

    public function getPO($id)
    {
        if ($this->session->userdata('mkh_logged')->role == 4) {
            $kode_buyer = $this->session->userdata('mkh_logged')->username;
            $query = $this->db->query("SELECT i.id as id_invoice, i.kode_buyer, i.kode_po, i.barang ,i.jumlah,i.alamat_export,b.id as id_barang,b.kode as kode_barang,b.*,bu.* FROM `invoice` as i JOIN barang as b on i.barang = b.id JOIN buyer as bu on i.kode_buyer = bu.kode_buyer WHERE i.kode_buyer = '$kode_buyer' and i.kode_po = '$id';");
        } else {
            $query = $this->db->query("SELECT i.id as id_invoice, i.kode_buyer, i.kode_po, i.barang ,i.jumlah,i.alamat_export,b.id as id_barang,b.kode as kode_barang,b.*,bu.* FROM `invoice` as i JOIN barang as b on i.barang = b.id JOIN buyer as bu on i.kode_buyer = bu.kode_buyer where i.kode_po = '$id';");
        }
        return $query->result();
    }
    public function getTransaksi($id)
    {
        return $this->db->get_where($this->tbtransaksi, ["kode_po" => $id])->row();
    }

    public function getById($id)
    {
        $query = $this->db->query("SELECT i.id as id_invoice, i.kode_buyer, i.kode_po, i.barang ,i.jumlah,i.proses,i.selesai,i.alamat_export,b.id as id_barang,b.*, b.id as kode_barang, bu.* FROM `invoice` as i JOIN barang as b on i.barang = b.id JOIN buyer as bu on i.kode_buyer = bu.kode_buyer WHERE i.id = '$id';");

        return $query->result();
    }

    public function proses_produksi()
    {
        $post = $this->input->post();

        $jumlah = $post['jumlah'] + $post['proses_sebelumnya'];
        $id = $post['id_invoice'];
        $sql = "UPDATE `invoice` SET `proses`='{$jumlah}' WHERE id = '{$id}'";
        $this->db->query($sql);
    }

    public function getBuyer()
    {
        $this->db->from($this->tbbuyer);
        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdBuyer($kode_buyer)
    {
        return $this->db->get_where($this->tbbuyer, ["kode_buyer" => $kode_buyer])->row();
    }


    public function saveBuyer()
    {
        $post = $this->input->post();
        $maxid =  $this->db->query("select max(id) as maxid from users")->row()->maxid;
        $this->kode_buyer = $post['kode_buyer'];
        $this->nama_buyer = $post['nama_buyer'];
        $this->email_buyer = $post['email_buyer'];
        $this->id_akun = $maxid + 1;

        return $this->db->insert($this->tbbuyer, $this);
    }
    public function buatAkunBuyer()
    {
        $post = $this->input->post();

        $nama = $post['nama_buyer'];
        $username = $post['kode_buyer'];
        $pswd = $post['kode_buyer'];
        $password = password_hash($pswd, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (`nama`, `username`, `password`, `role`) VALUES ('{$nama}','{$username}','{$password}','4')";
        $this->db->query($sql);
    }

    public function updateBuyer()
    {
        $post = $this->input->post();

        $this->kode_buyer = $post['kode_buyer'];
        $this->nama_buyer = $post['nama_buyer'];
        $this->email_buyer = $post['email_buyer'];

        return $this->db->update($this->tbbuyer, $this, array('kode_buyer' => $post['kode_lama']));
    }
    public function UpdateAkunBuyer()
    {
        $post = $this->input->post();

        $id_akun = $post['id_akun'];
        $nama = $post['nama_buyer'];
        $username = $post['kode_buyer'];
        $pswd = $post['kode_buyer'];
        $password = password_hash($pswd, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET nama = '{$nama}', username = '{$username}', password = '{$password}' WHERE id = '{$id_akun}'";
        $this->db->query($sql);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kode_buyer = $post['kode_buyer'];
        $this->kode_po = $this->carimaxpo() + 1;
        $this->alamat_export = $post['alamat_export'];
        return $this->db->insert($this->tbtransaksi, $this);
    }

    public function savePO()
    {
        $post = $this->input->post();
        $this->kode_buyer = $post['kode_buyer'];
        $this->kode_po =  $post['kode_po'];
        $this->barang = $post['barang'];
        $this->jumlah = $post['jumlah'];
        $this->alamat_export = $post['alamat_export'];
        return $this->db->insert($this->_table, $this);
    }

    public function updateTotalItemTransaksi()
    {
        $post = $this->input->post();
        $kode_po =  $post['kode_po'];
        $total_item = $post['total_item'] + 1;
        $sql = "UPDATE transaksi SET total_item = '{$total_item}' WHERE kode_po = '{$kode_po}'";
        $this->db->query($sql);
    }

    public function kurangiTotalItemTransaksi($kode_po, $total_itemnya)
    {

        $total_item = $total_itemnya - 1;
        $sql = "UPDATE transaksi SET total_item = '{$total_item}' WHERE kode_po = '{$kode_po}'";
        $this->db->query($sql);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->id = $post['id'];
        $this->kode_buyer = $post['kode_buyer'];
        $this->kode_po = $post['kode_po'];
        $this->barang = $post['barang'];
        $this->jumlah = $post['jumlah'];
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }
    public function update_invoice()
    {
        $post = $this->input->post();
        $this->kode_po = $post['kode_po'];
        $this->kode_buyer = $post['kode_buyer'];
        $this->alamat_export = $post['alamat_export'];
        $this->total_item = $post['total_item'];
        return $this->db->update($this->tbtransaksi, $this, array('kode_po' => $post['kode_po']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }


    private function carimaxpo()
    {
        $query = $this->db->query("SELECT max(kode_po) as max FROM `transaksi`;");
        $maxpo = $query->result();
        foreach ($maxpo as $po) {
            $lastpo = $po->max;
        }
        return $lastpo;
    }
}
