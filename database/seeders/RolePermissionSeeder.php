<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // siswa
        Permission::create(['name'=>'add-presensi']);
        Permission::create(['name'=>'add-permission']);

        // guru
        Permission::create(['name'=>'read-presensi']);
        Permission::create(['name'=>'read-dashboard']);

        // admin
        Permission::create(['name'=>'add-role-user']);
        Permission::create(['name'=>'edit-role-user']);
        Permission::create(['name'=>'read-user']);

        Role::create(['name'=>'siswa']);
        Role::create(['name'=>'guru']);
        Role::create(['name'=>'admin']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('add-role-user');
        $roleAdmin->givePermissionTo('edit-role-user');
        $roleAdmin->givePermissionTo('read-user');

        $roleSiswa = Role::findByName('siswa');
        $roleSiswa->givePermissionTo('add-presensi');
        $roleSiswa->givePermissionTo('add-permission');

        $roleGuru = Role::findByName('guru');
        $roleGuru->givePermissionTo('read-presensi');
        $roleGuru->givePermissionTo('read-dashboard');
    }
}
