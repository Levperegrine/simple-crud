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
        Schema::create('nomor_asuransis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->unique();
            $table->foreignId('jenis_asuransi_id')->constrained('jenis_asuransis')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomor_asuransis');
    }
};
