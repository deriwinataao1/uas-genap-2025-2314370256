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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('nama_penerima');
            $table->string('negara');
            $table->string('provinsi');
            $table->string('kota');
            $table->text('alamat_jalan');
            $table->string('kode_pos');
            $table->string('telepon');
            $table->string('email');
            $table->text('catatan')->nullable();
            $table->enum('pembayaran', ['cod', 'dana', 'ovo', 'bank']);
            $table->enum('status', ['proses', 'diterima', 'dikemas', 'diantar', 'selesai', 'ditolak'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
