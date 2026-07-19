<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->date('tanggal');
            $table->string('nama_pembeli')->nullable();
            $table->string('jenis_pelanggan')->default('umum'); // tamu, umum, internal
            $table->string('nomor_kamar')->nullable();
            $table->string('nomor_wa')->nullable();
            $table->string('status_laundry')->default('diterima'); // diterima, proses, selesai, diambil
            $table->string('status_pembayaran')->default('belum_lunas'); // belum_lunas, lunas
            $table->dateTime('tanggal_selesai')->nullable();
            $table->decimal('total', 15, 2)->default(0);

            // Kolom untuk menyimpan siapa yang memasukkan transaksi
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('transaksi');
    }
};
