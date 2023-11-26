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

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $admin = Role::findByName('admin');
        $admin->givePermissionTo('edit-Karyawan');
        $admin->givePermissionTo('hapus-Karyawan');

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('admin');
        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('user');
    }
}
