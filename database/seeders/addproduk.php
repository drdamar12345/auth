<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class addproduk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('tb_product_utama')->insert([
            [
                'nama_product' => 'SK8-Hi MTE',
                'merk' => 'vans',
                'keterangan' => 'des',
                'warna' => 'hitam_putih',
                'harga' => '44500000',
                'gambar' => 'gambar/SK8-Hi MTE.png',
            ],
            [
                'nama_product' => 'Old Skool Platform',
                'merk' => 'vans',
                'keterangan' => 'des',
                'warna' => 'hitam_putih',
                'harga' => '900000',
                'gambar' => 'gambar/Old Skool Platform.png',
            ],
            [
                'nama_product' => 'UltraRange Hi MTE',
                'merk' => 'vans',
                'keterangan' => 'des',
                'warna' => 'hitam_putih',
                'harga' => '1190000',
                'gambar' => 'gambar/UltraRange Hi MTE.png',
            ],
            [
                'nama_product' => 'Nike Air Huarache Run DNA Ch. 1 Pack',
                'merk' => 'nike',
                'keterangan' => 'des',
                'warna' => 'putih_biru',
                'harga' => '2400000',
                'gambar' => 'gambar/Nike Air Huarache Run DNA Ch. 1 Pack.jpg',
            ],
            [
                'nama_product' => 'Nike Air Max 270 React RS',
                'merk' => 'nike',
                'keterangan' => 'des',
                'warna' => 'putih_biru',
                'harga' => '1800000',
                'gambar' => 'gambar/Nike Air Max 270 React RS.jpg',
            ],
            [
                'nama_product' => 'Nike Air Jordan XXXV DNA',
                'merk' => 'nike',
                'keterangan' => 'des',
                'warna' => 'hitam_putih',
                'harga' => '3200000',
                'gambar' => 'gambar/Nike Air Jordan XXXV DNA.jpg',
            ],
            [
                'nama_product' => 'Chuck Taylor All Star',
                'merk' => 'converse',
                'keterangan' => 'des',
                'warna' => 'hitam_putih',
                'harga' => '900000',
                'gambar' => 'gambar/Chuck Taylor All Star.jpg',
            ],
            [
                'nama_product' => 'Chuck-Taylor-All-Star-Slip',
                'merk' => 'converse',
                'keterangan' => 'des',
                'warna' => 'hitam_putih',
                'harga' => '850000',
                'gambar' => 'gambar/Chuck-Taylor-All-Star-Slip.png',
            ],
            [
                'nama_product' => 'Chuck-Taylor-All-Star-Dainty',
                'merk' => 'converse',
                'keterangan' => 'des',
                'warna' => 'hitam_putih',
                'harga' => '700000',
                'gambar' => 'gambar/Chuck-Taylor-All-Star-Dainty.jpg',
            ],
        
        ]);
    }
}
