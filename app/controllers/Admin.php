<?php

class Admin extends Controller {
    public function index()
    {
        $data['title'] = 'Dashboard - NiceAdmin Bootstrap Template';
        $this->view('layout/admin-header', $data);
        $this->view('admin/index');
        $this->view('layout/admin-footer');
    }
}