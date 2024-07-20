<?php

use App\Core\Controller;

class Admin extends Controller
{
    private $registrationModel;
    private $userModel;

    public function __construct()
    {
        $this->registrationModel = $this->model('Registration');
        $this->userModel = $this->model('User');
        
        session_start();
        if (isset($_SESSION['admin_id']) && $_SESSION['admin_role'] === 'admin') {
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

    public function info_user()
    {
        $users = $this->userModel->getAllUsersByRole('user');

        $data['title'] = 'Info User';
        $data['users'] = $users;
        $this->view('layout/admin_header', $data);
        $this->view('admin/info_user', $data);
        $this->view('layout/admin_footer');
    }
    
    public function profil_admin()
    {
        $data['title'] = 'Profil Admin';
        $this->view('layout/admin_header', $data);
        $this->view('admin/profil_admin', $data);
        $this->view('layout/admin_footer');
    }
    
    public function detail_pendaftar()
    {
        $data['title'] = 'Detail Pendaftar';
        $this->view('layout/admin_header', $data);
        $this->view('admin/detail_pendaftar', $data);
        $this->view('layout/admin_footer');
    }
}
