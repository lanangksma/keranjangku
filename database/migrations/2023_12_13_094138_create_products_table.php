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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->decimal("price", 10, 2);
            $table->text("description");
            $table->unsignedBigInteger('category_id'); // Menambahkan kolom untuk menyimpan ID kategori

            // Menambahkan foreign key constraint ke tabel categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string("image")->nullable();
            $table->integer("count")->default(0);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
