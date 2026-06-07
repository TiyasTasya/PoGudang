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
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('no_pr')->unique();
            $table->date('tanggal_pr');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->integer('qty_pesan');
            $table->integer('pajak_persen')->default(0);
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
