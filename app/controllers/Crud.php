<?php

class Crud extends Controller {
    public function index()
    {
        $data['title'] = 'CRUD - NiceAdmin Bootstrap Template';
        $this->view('layout/admin-header', $data);
        $this->view('crud/index');
        $this->view('layout/admin-footer');
    }
}