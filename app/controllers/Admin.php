<?php

use App\Core\Controller;

class Admin extends Controller {
    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->view('layout/admin_header', $data);
        $this->view('admin/index');
        $this->view('layout/admin_footer');
    }
}