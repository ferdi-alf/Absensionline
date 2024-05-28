<?php

namespace App\Models;

use App\Models\Absensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['tingkat', 'jurusan'];
    public function absensins()
    {
        return $this->hasMany(Absensi::class);
    }
}