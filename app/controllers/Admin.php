<?php

use App\Core\Controller;

class Admin extends Controller {
    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $this->view('layout/admin_header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('layout/admin_footer');
    }

    public function kelola_data()
    {
        $data['title'] = 'Kelola Data';
        $this->view('layout/admin_header', $data);
        $this->view('admin/kelola_data', $data);
        $this->view('layout/admin_footer');
    }

    public function peserta()
    {
        $data['title'] = 'Peserta';
        $this->view('layout/admin_header', $data);
        $this->view('admin/peserta', $data);
        $this->view('layout/admin_footer');
    }
}