<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('product_subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('product_categories')
                ->cascadeOnDelete();
            $table->string('name');
            $table->boolean('highlighted')->default(false);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')
                ->constrained('product_subcategories')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('benefits')->nullable();
            $table->string('button_text', 100)->default('Order Now');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_subcategories');
        Schema::dropIfExists('product_categories');
    }
};
