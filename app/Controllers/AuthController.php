<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function index()
    {
        // Redirect to login view
        return view('login');
    }

    public function login()
    {
        // Load session library
        $session = session();

        // Handle the POST request
        if ($this->request->getMethod() === 'post') {
            $penggunaModel = new PenggunaModel();

            // Get the username and password from form input
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Verify user credentials
            $user = $penggunaModel->verifyUser($username, $password);

            if ($user) {
                // Set session data
                $sessionData = [
                    'id_user'    => $user['id_user'],
                    'username'   => $user['username'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true,
                ];

                $session->set($sessionData);

                // Redirect to dashboard based on user role
                switch ($user['role']) {
                    case 'Admin':
                        return redirect()->to('/main/index'); // Redirect to Main controller's index
                    case 'Teknisi':
                        return redirect()->to('/teknisi/index'); // Redirect to Teknisi controller's index
                    case 'Manajer':
                        return redirect()->to('/ManajerController/index'); // Redirect to Manajer controller's index
                    default:
                        $session->setFlashdata('error', 'Role tidak dikenali!');
                        return redirect()->back();
                }
            } else {
                // Invalid login credentials
                $session->setFlashdata('error', 'Username atau Password salah!');
                return redirect()->back();
            }
        }

        // Load login view if GET request
        return view('login');
    }

    public function logout()
    {
        // Destroy session and redirect to login page
        session()->destroy();
        return redirect()->to('/AuthController');
    }
}
