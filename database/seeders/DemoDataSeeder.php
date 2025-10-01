<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $g1 = Gudang::firstOrCreate(['kode'=>'GDG-1'],['nama'=>'Gudang Utama']);
        $g2 = Gudang::firstOrCreate(['kode'=>'GDG-2'],['nama'=>'Gudang Cabang']);

        $admin = User::firstOrCreate(['email'=>'admin@tcl.com'],[
            'name'=>'Admin', 'password'=>Hash::make('password'), 'gudang_id'=>$g1->id,
        ])->assignRole('admin');

        $staff = User::firstOrCreate(['email'=>'staff@tcl.com'],[
            'name'=>'Staff', 'password'=>Hash::make('password'), 'gudang_id'=>$g2->id,
        ])->assignRole('staff');

        $viewer = User::firstOrCreate(['email'=>'viewer@tcl.com'],[
            'name'=>'Viewer', 'password'=>Hash::make('password'), 'gudang_id'=>$g1->id,
        ])->assignRole('viewer');

        Barang::firstOrCreate(['kode_barang'=>'BRG-001'],[
            'nama_barang'=>'Karton Box','stok'=>100,'gudang_id'=>$g1->id
        ]);
        Barang::firstOrCreate(['kode_barang'=>'BRG-002'],[
            'nama_barang'=>'Lakban','stok'=>50,'gudang_id'=>$g2->id
        ]);
    }
}
