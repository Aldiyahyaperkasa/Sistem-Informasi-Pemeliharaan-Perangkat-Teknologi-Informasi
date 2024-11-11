<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class PenggunaController extends Controller
{

    public function index()
    {
        $penggunaModel = new PenggunaModel();

        // Ambil role dari query string atau default ke "all" (semua role)
        $roleFilter = $this->request->getGet('role') ?? 'all';

        // Tentukan berapa banyak data yang ingin ditampilkan per halaman
        $perPage = 2;

        // Buat query dasar
        if ($roleFilter === 'all') {
            // Ambil semua pengguna jika "all" dipilih
            $pengguna = $penggunaModel;
        } else {
            // Filter pengguna berdasarkan role yang dipilih
            $pengguna = $penggunaModel->where('role', $roleFilter);
        }

        // Pagination: ambil data pengguna dengan paginasi
        $data['pengguna'] = $pengguna->paginate($perPage);
        $data['pager'] = $penggunaModel->pager;

        // Ambil daftar role yang unik
        $data['roles'] = $penggunaModel->select('role')->distinct()->findAll();

        // Untuk menyimpan role yang dipilih ke view
        $data['selectedRole'] = $roleFilter;

        return view('admin/view_pengguna', $data);
    }


    public function create()
    {
        return view('admin/create_pengguna');
    }

    public function store()
    {
        $penggunaModel = new PenggunaModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ];

        if ($penggunaModel->insert($data)) {
            session()->setFlashdata('success', 'Pengguna berhasil ditambahkan.');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan pengguna.');
        }
        
        return redirect()->to('/PenggunaController');
    }

    public function edit($id)
    {
        $penggunaModel = new PenggunaModel();
        $data['pengguna'] = $penggunaModel->find($id);

        return view('admin/edit_pengguna', $data);
    }

    public function update($id)
    {
        $penggunaModel = new PenggunaModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role'),
        ];

        // Jika password diisi, update password
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($penggunaModel->update($id, $data)) {
            session()->setFlashdata('success', 'Pengguna berhasil diupdate');        
        } else {
            session()->setFlashdata('error', 'Gagal update');
        }
        return redirect()->to('/PenggunaController');
    }

    public function delete($id)
    {
        $penggunaModel = new PenggunaModel();
        
        if ($penggunaModel->delete($id)) {
            session()->setFlashdata('success', 'Pengguna berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus pengguna.');
        }

        return redirect()->to('/PenggunaController');
    }

}
