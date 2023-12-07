<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'edit-Karyawan']);
        Permission::create(['name' => 'hapus-Karyawan']);
        Permission::create(['name' => 'input-nilai']);
        Permission::create(['name' => 'buat-laporan']);
        Permission::create(['name' => 'input-karyawan']);
        Permission::create(['name' => 'lihat-rekomendasi']);



        Role::create(['name' => 'admin']);
        Role::create(['name' => 'HRD']);
        Role::create(['name' => 'head of department']);
        Role::create(['name' => 'general manager']);

        $admin = Role::findByName('admin');
        $admin->givePermissionTo('edit-Karyawan');
        $admin->givePermissionTo('hapus-Karyawan');
        $admin->givePermissionTo('input-nilai');
        $admin->givePermissionTo('buat-laporan');
        $admin->givePermissionTo('input-karyawan');
        $admin->givePermissionTo('lihat-rekomendasi');


        $hod = Role::findByName('head of department');
        $hod->givePermissionTo('input-karyawan');
        $hod->givePermissionTo('edit-Karyawan');
        $hod->givePermissionTo('hapus-Karyawan');
        $hod->givePermissionTo('input-nilai');
        $hod->givePermissionTo('buat-laporan');

        $gm = Role::findByName('general manager');
        $gm->givePermissionTo('edit-Karyawan');
        $gm->givePermissionTo('lihat-rekomendasi');

        $hrd = Role::findByName('HRD');
        $hrd->givePermissionTo('input-nilai');

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('admin');
        User::create([
            'name' => 'hrd',
            'email' => 'user@example.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('HRD');
        User::create([
            'name' => 'general manajer',
            'email' => 'gm@example.com',
            'password' => bcrypt('gm123456')
        ])->assignRole('general manager');
        User::create([
            'name' => 'head of department',
            'email' => 'hod@example.com',
            'password' => bcrypt('hod123456')
        ])->assignRole('head of department');
    }
}
