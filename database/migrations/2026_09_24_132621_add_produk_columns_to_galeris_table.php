<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada (untuk keamanan)
            if (!Schema::hasColumn('galeris', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('judul');
            }
            if (!Schema::hasColumn('galeris', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('galeris', 'harga')) {
                $table->decimal('harga', 12, 2)->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('galeris', 'is_produk')) {
                $table->boolean('is_produk')->default(false)->after('harga');
            }
            if (!Schema::hasColumn('galeris', 'satuan')) {
                $table->string('satuan', 50)->nullable()->after('is_produk');
            }
            if (!Schema::hasColumn('galeris', 'stok')) {
                $table->integer('stok')->nullable()->after('satuan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('galeris', function (Blueprint $table) {
            $columns = ['slug', 'deskripsi', 'harga', 'is_produk', 'satuan', 'stok'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('galeris', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
