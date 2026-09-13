<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->model('UserModel');
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            redirect('products');
            exit;
        }

        $data = [
            'error' => null,
            'identity' => '',
        ];

        if ($this->io->method() === 'post') {
            $identity = trim((string) $this->io->post('identity'));
            $password = (string) $this->io->post('password');
            $data['identity'] = $identity;

            $user = $this->UserModel->find_by_identity($identity);

            if ($user && password_verify($password, $user['password'])) {
                $this->session->regenerate_on_login();
                $this->session->set_userdata('user', [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'email'    => $user['email'],
                    'role'     => $user['role'],
                ]);

                redirect('products');
                exit;
            }

            $data['error'] = 'The details you entered do not match an active account.';
        }

        $this->call->view('auth/login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
        exit;
    }
}
