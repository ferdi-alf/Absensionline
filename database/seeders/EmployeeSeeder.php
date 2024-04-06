<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'nama' => 'Ferdi S.kom',
            'username' => 'ferdi',
            'tingkat' => 'X',
            'jurusan' => 'RPL',
            'password' => bcrypt('1234'),
        ]);
    }
}
