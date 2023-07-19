<?php

class MoUser extends CI_Model
{
    private $_table = "users";

    public function doLogin()
    {
        $post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('username', $post["username"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if ($user) {
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);

            if ($isPasswordTrue) {
                // login sukses yay!
                $this->session->set_userdata(['mkh_logged' => $user]);
                // $this->_updateLastLogin($user->id);
                return true;
            }
        }

        // login gagal
        return false;
    }

    public function isNotLogin()
    {
        return $this->session->userdata('mkh_logged') === null;
    }
    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    // private function _updateLastLogin($id)
    // {
    //     $date = new DateTime('now');
    //     $saiki = $date->format('Y-m-d H:i');
    //     $sql = "UPDATE {$this->_table} SET last_login='{$saiki}' WHERE id={$id}";
    //     $this->db->query($sql);
    // }
    // public function update_profile()
    // {
    //     $post = $this->input->post();
    //     $nama = $post['nama'];
    //     $id = $post['id'];

    //     $sql = "UPDATE {$this->_table} SET nama = '{$nama}'  WHERE id={$id}";
    //     $this->db->query($sql);
    // }
    public function ubah_password()
    {
        $post = $this->input->post();
        $pswd = $post['password'];
        $password = password_hash($pswd, PASSWORD_DEFAULT);
        $id = $post['id'];
        $sql = "UPDATE {$this->_table} SET password = '{$password}' WHERE id={$id}";
        $this->db->query($sql);
    }

    public function reset_password($id)
    {

        $password = password_hash('123456', PASSWORD_DEFAULT);
        $sql = "UPDATE {$this->_table} SET password = '{$password}' WHERE id={$id}";
        return $this->db->query($sql);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->username = $post["username"];
        $pwd = $post['password'];
        $this->password =  password_hash($pwd, PASSWORD_DEFAULT);
        $this->nama = $post["nama"];
        $this->role = $post["role"];
        return $this->db->insert($this->_table, $this);
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}
