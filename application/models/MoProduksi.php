<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MoProduksi extends CI_Model
{
    private $_table = 'produksi';

    public function getOrderSupplier($id)
    {
        $query = $this->db->query("SELECT sp.*, count(pr.kode_po) as produksi, inv.kode_buyer,pr.kode_po, bu.nama_buyer from supplier as sp left join produksi as pr on sp.kode_sup = pr.kode_sup join invoice as inv on pr.id_invoice = inv.id join buyer as bu on inv.kode_buyer = bu.kode_buyer where pr.kode_sup = '$id' group by pr.kode_po;");

        return $query->result();
    }
    public function getSupplier()
    {
        $query = $this->db->query("SELECT sp.*, count(distinct pr.kode_po) as produksi from supplier as sp left join produksi as pr on sp.kode_sup = pr.kode_sup group by sp.kode_sup");

        return $query->result();
    }
    public function getProsesSupplier()
    {
        $query = $this->db->query("SELECT sum(p.jumlah-p.prd_selesai) as proses, s.nama_sup FROM `produksi` as p right join supplier as s on p.kode_sup = s.kode_sup GROUP BY s.kode_sup");

        return $query->result();
    }
    public function produksiSupplier($sup, $buyer, $po)
    {
        $query = $this->db->query("SELECT pr.*, sp.nama_sup,br.*,br.kode as kode_barang,inv.kode_buyer from produksi as pr join supplier as sp on pr.kode_sup = sp.kode_sup join barang as br on pr.kode_barang = br.id join invoice as inv on pr.id_invoice = inv.id where pr.kode_sup = '$sup' and inv.kode_buyer = '$buyer' and pr.kode_po = '$po';");

        return $query->result();
    }
    public function filterproduksisupplier($sup)
    {
        $query = $this->db->query("SELECT pr.jumlah - pr.prd_selesai as proses,pr.*, sp.nama_sup,br.*,br.kode as kode_barang,inv.kode_buyer, pr.kode_barang as kodenya_barang from produksi as pr join supplier as sp on pr.kode_sup = sp.kode_sup join barang as br on pr.kode_barang = br.id join invoice as inv on pr.id_invoice = inv.id where pr.kode_sup = '$sup' and pr.jumlah > pr.prd_selesai;");

        return $query->result();
    }
    public function catatanProduksi($id)
    {
        $query = $this->db->query("SELECT pr.jumlah - pr.prd_selesai as proses,pr.*, sp.nama_sup,br.*,br.kode as kode_barang,inv.kode_buyer, pr.kode_barang as kodenya_barang from produksi as pr join supplier as sp on pr.kode_sup = sp.kode_sup join barang as br on pr.kode_barang = br.id join invoice as inv on pr.id_invoice = inv.id where pr.id_prod = '$id' and pr.jumlah > pr.prd_selesai;");

        return $query->result();
    }
    public function getByKodePO($kode_po = null, $kode_barang = null)
    {
        $query = $this->db->query("SELECT pr.*, sp.nama_sup from produksi as pr join supplier as sp on pr.kode_sup = sp.kode_sup where pr.kode_po = '{$kode_po}' and pr.kode_barang = '{$kode_barang}'");

        return $query->result();
    }

    public function getChat($id)
    {
        $query = $this->db->query("SELECT c.*,b.kode as kode_barang,b.nama as nama_barang, u.nama as nama_user FROM `chat` as c join produksi as p on c.id_prod = p.id_prod join users as u on c.id_user = u.id join barang as b on p.kode_barang = b.id where c.id_prod = '{$id}' order by id_chat desc;");

        return $query->result();
    }

    public function isiChat($id)
    {
        $query = $this->db->query("SELECT isi_chat FROM `chat` WHERE id_prod = '{$id}' group by id_prod");

        return $query->result();
    }


    public function statusChat($id)
    {
        $query = $this->db->query("SELECT p.id_prod , b.kode, b.nama from produksi as p join barang as b on p.kode_barang = b.id where p.id_prod = '{$id}'");

        return $query->result();
    }

    public function saveKomentar()
    {
        $post = $this->input->post();
        $this->isi_chat = $post['isi_chat'];
        $this->time_chat = date("d/m/Y h:ia");
        $this->id_prod = $post['id_prod'];
        $this->id_user = $post['id_user'];

        return $this->db->insert('chat', $this);
    }
    public function save()
    {
        $post = $this->input->post();
        $kode_po = $post['kode_po'];
        $this->kode_po = $kode_po;
        $this->kode_sup = $post['kode_sup'];
        $this->kode_barang = $post['kode_barang'];
        $this->jumlah = $post['jumlah'];
        $this->prd_selesai = 0;
        $this->kode_tambahan = $this->maxKodeTambahan($kode_po) + 1;
        $this->prd_start = date('d-m-Y');
        $d = strtotime("+2 Months");
        $this->prd_deadline = date('d-m-Y', $d);
        $this->id_invoice = $post['id_invoice'];
        return $this->db->insert($this->_table, $this);
    }

    public function updateProduksiSelesai()
    {
        $post = $this->input->post();
        $id = $post['idprod'];
        $prd_selesai = $post['selesai'];
        $sql = "UPDATE produksi set prd_selesai = '{$prd_selesai}' WHERE id_prod = '{$id}'";
        $this->db->query($sql);
    }

    private function maxKodeTambahan($kode_po)
    {
        $kode_tambahan = $this->db->query("SELECT max(kode_tambahan) as kode_tbh FROM `produksi` where kode_po = '{$kode_po}';")->row()->kode_tbh;

        return $kode_tambahan;
    }
    public function delete($kode_po, $id_barang)
    {
        return $this->db->delete($this->_table, array("kode_po" => $kode_po, "kode_barang" => $id_barang));
    }
}
