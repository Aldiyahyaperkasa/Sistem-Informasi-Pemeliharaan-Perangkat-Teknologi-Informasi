<?php

namespace App\Controllers;

use App\Models\PerangkatModel;

class PerangkatController extends BaseController
{
    protected $perangkatModel;

    public function __construct()
    {
        $this->perangkatModel = new PerangkatModel();
    }
    // Menampilkan daftar perangkat
    public function index()
    {
        $perPage = 10;

        // Ambil query pencarian dari input
        $search = $this->request->getGet('search');
        $department = $this->request->getGet('department');
        $tipe_perangkat = $this->request->getGet('tipe_perangkat');

        // Inisialisasi query
        $this->perangkatModel->select('*');

        // Jika pencarian spesifik diisi
        if ($search) {
            $this->perangkatModel->groupStart()
                                ->like('nama_perangkat', $search)
                                ->orLike('department', $search)
                                ->orLike('tipe_perangkat', $search)
                                ->groupEnd();
        }

        // Jika filter per kolom diisi
        if (!empty($department)) {
            $this->perangkatModel->where('department', $department);
        }
        if (!empty($tipe_perangkat)) {
            $this->perangkatModel->where('tipe_perangkat', $tipe_perangkat);
        }

        // Ambil data perangkat dengan pagination
        $data['perangkat'] = $this->perangkatModel->paginate($perPage, 'perangkat');
        $data['pager'] = $this->perangkatModel->pager;

        // Ambil data untuk dropdown filter
        $data['departments'] = $this->perangkatModel->distinct()->findColumn('department');
        $data['tipePerangkat'] = $this->perangkatModel->distinct()->findColumn('tipe_perangkat');

        // Pass filter values dan search ke view
        $data['search'] = $search;
        $data['department'] = $department;
        $data['tipe_perangkat'] = $tipe_perangkat;
        $data['currentPage'] = $this->request->getVar('page_perangkat') ?? 1;
        $data['perPage'] = $perPage;


        return view('admin/view_perangkat', $data);
    }


    // Menampilkan form untuk menambahkan perangkat
    public function create()
    {
        return view('admin/create_perangkat');
    }
    //simpan data perangkat baru
    public function store()
    {
        $namaPerangkat = $this->request->getPost('nama_perangkat');
        $existingDevice = $this->perangkatModel->where('nama_perangkat', $namaPerangkat)->first();

        // Periksa apakah nama perangkat sudah ada
        if ($existingDevice) {
            session()->setFlashdata('error', 'Nama perangkat sudah ada.');
            return redirect()->to('/PerangkatController');
        }
        
        $data = [
            'nama_perangkat' => $this->request->getPost('nama_perangkat'),
            'department' => $this->request->getPost('department'),
            'tipe_perangkat' => $this->request->getPost('tipe_perangkat')
        ];

        if($this->perangkatModel->save($data)) {
            session()->setFlashdata('success', 'perangkat berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'gagal ditambahkan');
        }
        return redirect()->to('/PerangkatController');
    }
    // Menampilkan form untuk mengedit perangkat
    public function edit($id)
    {
        $data['perangkat'] = $this->perangkatModel->find($id);
        return view('admin/edit_perangkat', $data);
    }
    // Mengupdate data perangkat
    public function update()
    {
        $id = $this->request->getPost('id_perangkat');
        $data = [
            'nama_perangkat' => $this->request->getPost('nama_perangkat'),
            'department' => $this->request->getPost('department'),
            'tipe_perangkat' => $this->request->getPost('tipe_perangkat')
        ];

        if ($this->perangkatModel->update($id, $data)) {
            session()->setFlashdata('success', 'perangkat berhasil diupdate');
        } else {
            session()->setFlashdata('error', 'gagal diupdate');
        }

        return redirect()->to('/PerangkatController');
    }
    // Menghapus perangkat dari database
    public function delete($id)
    {
        try {
            if ($this->perangkatModel->delete($id)) {
                session()->setFlashdata('success', 'Perangkat berhasil dihapus');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus perangkat');
            }
        } catch (\Exception $e) {
            // Tangani error yang tidak terduga
            session()->setFlashdata('error', 'Terjadi kesalahan saat menghapus perangkat: ' . $e->getMessage());
        }

        return redirect()->to('/PerangkatController');
    }

}
