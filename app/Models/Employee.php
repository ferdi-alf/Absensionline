<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'id', 'nama', 'username', 'tingkat', 'jurusan', 'password',
    ];

    protected $guarded = [];
    // Menentukan kolom yang digunakan untuk otentikasi
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function deleteGuru($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();
            return true; // Jika penghapusan berhasil
        } else {
            return false; // Jika data tidak ditemukan
        }
    }

    protected $casts = [
        'password' => 'hashed',
    ];
}