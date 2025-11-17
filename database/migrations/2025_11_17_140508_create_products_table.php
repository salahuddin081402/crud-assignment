<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                                   // id (PK)
            $table->string('product_id')->unique();         // product_id (required, unique)
            $table->string('name');                         // name (required)
            $table->text('description')->nullable();        // description (optional)
            $table->decimal('price', 10, 2);                // price (required)
            $table->integer('stock')->nullable();           // stock (optional)
            $table->string('image');                        // image (required)
            $table->timestamps();                           // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
