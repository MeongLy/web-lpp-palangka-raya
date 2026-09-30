<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->string('gambar')->nullable();
            $table->string('link')->nullable();
            $table->string('link_label')->nullable()->default('Selengkapnya');

            // Tipe tampilan
            $table->enum('tipe', ['popup', 'banner', 'keduanya'])->default('popup');

            // Prioritas (untuk multiple popup)
            $table->integer('prioritas')->default(0);

            // Jadwal tayang
            $table->timestamp('mulai_tayang')->nullable();
            $table->timestamp('selesai_tayang')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
