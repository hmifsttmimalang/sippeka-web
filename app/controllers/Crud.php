<?php

use App\Core\Controller;

class Crud extends Controller {
    public function index()
    {
        $data['title'] = 'CRUD';
        $this->view('layout/admin-header', $data);
        $this->view('crud/index');
        $this->view('layout/admin-footer');
    }
}