<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StokBarang;
use App\Models\ProdukJasa;

class ProdukJasaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Stok Barang (Bahan & Produk Penjualan)
        $detergen = StokBarang::create([
            'nama_barang' => 'Detergen Premium',
            'satuan' => 'kg',
            'stok' => 50,
            'harga_beli' => 15000,
            'harga_jual' => 0,
        ]);

        $softener = StokBarang::create([
            'nama_barang' => 'Pelembut Softener Blue',
            'satuan' => 'liter',
            'stok' => 30,
            'harga_beli' => 12000,
            'harga_jual' => 0,
        ]);

        $pewangi = StokBarang::create([
            'nama_barang' => 'Pewangi Lavender',
            'satuan' => 'liter',
            'stok' => 20,
            'harga_beli' => 20000,
            'harga_jual' => 0,
        ]);

        $hangerStok = StokBarang::create([
            'nama_barang' => 'Hanger Plastik',
            'satuan' => 'pcs',
            'stok' => 500,
            'harga_beli' => 800,
            'harga_jual' => 1500,
        ]);

        $plastikStok = StokBarang::create([
            'nama_barang' => 'Plastik Packing Laundry 5kg',
            'satuan' => 'pcs',
            'stok' => 1000,
            'harga_beli' => 200,
            'harga_jual' => 500,
        ]);

        // 2. Seed Produk & Jasa (Layanan Laundry & Produk POS)
        // Jasa Laundry Kiloan
        ProdukJasa::create([
            'nama' => 'Laundry Kiloan Cuci Setrika (Regular 2-3 Hari)',
            'jenis' => 'jasa',
            'harga' => 7000,
            'jumlah' => 1,
            'satuan' => 'kg',
            'stok_barang_id' => null,
        ]);

        ProdukJasa::create([
            'nama' => 'Laundry Kiloan Cuci Setrika (Express 1 Hari)',
            'jenis' => 'jasa',
            'harga' => 12000,
            'jumlah' => 1,
            'satuan' => 'kg',
            'stok_barang_id' => null,
        ]);

        // Jasa Laundry Satuan
        ProdukJasa::create([
            'nama' => 'Laundry Satuan Sprei (Bed Sheet)',
            'jenis' => 'jasa',
            'harga' => 15000,
            'jumlah' => 1,
            'satuan' => 'pcs',
            'stok_barang_id' => null,
        ]);

        ProdukJasa::create([
            'nama' => 'Laundry Satuan Selimut (Blanket)',
            'jenis' => 'jasa',
            'harga' => 20000,
            'jumlah' => 1,
            'satuan' => 'pcs',
            'stok_barang_id' => null,
        ]);

        ProdukJasa::create([
            'nama' => 'Laundry Satuan Jas (Suit)',
            'jenis' => 'jasa',
            'harga' => 25000,
            'jumlah' => 1,
            'satuan' => 'pcs',
            'stok_barang_id' => null,
        ]);

        // Jasa Dry Cleaning
        ProdukJasa::create([
            'nama' => 'Dry Cleaning Gaun (Dress)',
            'jenis' => 'jasa',
            'harga' => 40000,
            'jumlah' => 1,
            'satuan' => 'pcs',
            'stok_barang_id' => null,
        ]);

        // Produk Penjualan (Toko)
        ProdukJasa::create([
            'nama' => 'Hanger Plastik Laundry',
            'jenis' => 'produk',
            'harga' => 1500,
            'jumlah' => 1,
            'satuan' => 'pcs',
            'stok_barang_id' => $hangerStok->id,
        ]);

        ProdukJasa::create([
            'nama' => 'Plastik Packing Extra',
            'jenis' => 'produk',
            'harga' => 500,
            'jumlah' => 1,
            'satuan' => 'pcs',
            'stok_barang_id' => $plastikStok->id,
        ]);
    }
}
