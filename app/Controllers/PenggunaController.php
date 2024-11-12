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

        // Ambil daftar role yang unik
        $data['roles'] = $penggunaModel->select('role')->distinct()->findAll();

        $perPage = 15;

        // Jika role yang dipilih adalah "all", ambil semua data, dengan pagination
        if ($roleFilter === 'all') {
            $data['pengguna'] = $penggunaModel->paginate($perPage, 'pengguna'); // menampilkan 10 data per halaman
        } else {
            // Jika role spesifik dipilih, filter berdasarkan role, dengan pagination
            $data['pengguna'] = $penggunaModel->where('role', $roleFilter)->paginate($perPage, 'pengguna');
        }

        // Pagination object
        $data['pager'] = $penggunaModel->pager;  // ini harus diinisialisasi

        // Untuk menyimpan role yang dipilih ke view
        $data['selectedRole'] = $roleFilter;

        $data['currentPage'] = $this->request->getVar('page_pengguna') ?? 1;

        $data['perPage'] = $perPage;

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
