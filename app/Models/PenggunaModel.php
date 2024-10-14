<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'role'];

    public function verifyUser($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Tambah pengguna baru
    public function createUser($data)
    {
        return $this->insert($data);
    }

    // Update pengguna
    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }

    // Hapus pengguna
    public function deleteUser($id)
    {
        return $this->delete($id);
    }

}
