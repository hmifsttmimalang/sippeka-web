<?php

use App\Core\Controller;

class Auth extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userModel = $this->model('User');
            $user = $userModel->login($username, $password);

            if ($user) {
                session_start();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header('Location: ' . MAIN_URL . 'admin/dashboard');
                } else {
                    header('Location: ' . MAIN_URL);
                }

            } else if (empty($username) && empty($password)) {
                $data['title'] = 'Login - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/login', ['error' => 'Masukkan username dan password']);
                $this->view('layout/auth_footer');
            } else {
                $data['title'] = 'Login - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/login', ['error' => 'Username atau password salah atau belum terdaftar']);
                $this->view('layout/auth_footer');
            }
        } else {
            $data['title'] = 'Login - SIPPEKA';
            $this->view('layout/auth_header', $data);
            $this->view('auth/login');
            $this->view('layout/auth_footer');
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (empty($username) || empty($password)) {
                $data['title'] = 'Register - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/register', ['error' => 'Masukkan Username dan Password!']);
                $this->view('layout/auth_footer');
                return;
            } else if ($password !== $confirm_password) {
                $data['title'] = 'Register - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/register', ['error' => 'Password tidak sama!']);
                $this->view('layout/auth_footer');
            } else {
                $userModel = $this->model('User');
    
                if ($userModel->register([
                    'nama' => $nama,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                ])) {
                    header('Location: ' . MAIN_URL . 'auth/login');
                }
            }
        } else {
            $data['title'] = 'Register - SIPPEKA';
            $this->view('layout/auth_header', $data);
            $this->view('auth/register');
            $this->view('layout/auth_footer');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /auth/login');
    }
}
