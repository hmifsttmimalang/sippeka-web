<?php

use App\Core\Controller;

class Admin extends Controller
{
    private $registrationModel;

    public function __construct()
    {
        $this->registrationModel = $this->model('Registration');
        
        session_start();
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            return;
        } else {
            header('Location: ' . MAIN_URL . 'auth/login');
            exit;
        }
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $this->view('layout/admin_header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('layout/admin_footer');
    }
    
    public function kelola_data()
    {        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $keterangan = $_POST['keterangan'];
            
            if ($this->registrationModel->updateRegistrationStatus($id, $keterangan)) {
                header('Location: ' . MAIN_URL . 'admin/kelola_data');
                exit;
            }
        }

        $registrations = $this->registrationModel->getAllRegistrations();
        
        $data['title'] = 'Kelola Data';
        $this->view('layout/admin_header', $data);
        $this->view('admin/kelola_data', ['title' => 'Kelola Data', 'registrations' => $registrations]);
        $this->view('layout/admin_footer');
    }

    public function peserta()
    {
        $registrations = $this->registrationModel->getAllRegistrations();

        $data['title'] = 'Peserta';
        $this->view('layout/admin_header', $data);
        $this->view('admin/peserta', ['title' => 'Peserta', 'registrations' => $registrations]);
        $this->view('layout/admin_footer');
    }
}
