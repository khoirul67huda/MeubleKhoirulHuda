<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("MoUser");

        $this->load->library('form_validation');
    }
    public function index()
    {
        show_404();
    }

    public function login()
    {
        if (!$this->MoUser->isNotLogin()) redirect(base_url('admin'));
        // jika form login disubmit
        if ($this->input->post()) {
            if ($this->MoUser->doLogin()) {
                redirect(base_url('admin'));
            } else {
?>
                <script>
                    window.alert("Gagal Login. Periksa Penulisan Username dan Password Anda!");
                </script>
<?php
            }
        }

        // tampilkan halaman login
        $this->load->view("login_form.php");
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('User/login'));
    }
}
