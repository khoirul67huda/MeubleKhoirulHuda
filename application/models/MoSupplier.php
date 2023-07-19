<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MoSupplier extends CI_Model
{

    private $tbsupplier = 'supplier';

    public function getsupplier()
    {
        $this->db->from($this->tbsupplier);
        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdsupplier($kode_sup)
    {
        return $this->db->get_where($this->tbsupplier, ["kode_sup" => $kode_sup])->row();
    }

    public function savesupplier()
    {
        $post = $this->input->post();

        $this->kode_sup = $post['kode_sup'];
        $this->nama_sup = $post['nama_sup'];
        $this->alamat_sup = $post['alamat_sup'];


        return $this->db->insert($this->tbsupplier, $this);
    }

    public function updatesupplier()
    {
        $post = $this->input->post();

        $this->kode_sup = $post['kode_sup'];
        $this->nama_sup = $post['nama_sup'];
        $this->alamat_sup = $post['alamat_sup'];

        return $this->db->update($this->tbsupplier, $this, array('kode_sup' => $post['kode_lama']));
    }

    public function deleteSupplier($kode_sup)
    {

        return $this->db->delete($this->tbsupplier, array("kode_sup" => $kode_sup));
    }


    /*     public function save()
    {
        $post = $this->input->post();
        $this->kode_buyer = $post['kode_buyer'];
        $this->kode_po = $this->carimaxpo() + 1;
        $this->barang = $post['barang'];
        $this->jumlah = $post['jumlah'];
        $this->alamat_export = $post['alamat_export'];
        return $this->db->insert($this->_table, $this);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->id = $post['id'];
        $this->kode_buyer = $post['kode_buyer'];
        $this->kode_po = $post['kode_po'];
        $this->barang = $post['barang'];
        $this->jumlah = $post['jumlah'];
        $this->alamat_export = $post['alamat_export'];
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

    private function carimaxpo()
    {
        $query = $this->db->query("SELECT max(kode_po) as max FROM `invoice`;");
        $maxpo = $query->result();
        foreach ($maxpo as $po) {
            $lastpo = $po->max;
        }
        return $lastpo;
    } */
}
