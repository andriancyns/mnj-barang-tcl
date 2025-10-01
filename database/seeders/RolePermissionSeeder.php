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
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    
        $perms = [
            'barang.viewAny', 'barang.view',
            'barang.create', 'barang.update', 'barang.delete'
        ];

        foreach ($perms as $p) Permission::firstOrCreate(['name' => $p]);

        // Roles
        $admin  = Role::firstOrCreate(['name' => 'admin']);
        $staff  = Role::firstOrCreate(['name' => 'staff']);
        $viewer = Role::firstOrCreate(['name' => 'viewer']);

        // Grant permissions to roles
        $admin->givePermissionTo($perms);
        $staff->givePermissionTo(['barang.viewAny', 'barang.view', 'barang.create', 'barang.update']);
        $viewer->givePermissionTo(['barang.viewAny', 'barang.view']);

        /*
        admin: akses semua gudang + CRUD penuh
        staff: CRUD tapi hanya untuk gudangnya
        viewer: hanya lihat 
         */


    }
}
