<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logbook_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logbook_id')->constrained('logbooks')->onDelete('cascade');
            $table->foreignId('shift_id')->constrained('shifts');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('jumlah_kiloan', 8, 2)->default(0);
            $table->decimal('harga_kiloan', 15, 2)->default(0);
            $table->integer('jumlah_satuan')->default(0);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->integer('jumlah_dry_cleaning')->default(0);
            $table->decimal('harga_dry_cleaning', 15, 2)->default(0);
            $table->decimal('total_uang', 15, 2)->default(0);
            $table->decimal('pendapatan_lain', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook_details');
    }
};
