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
        Schema::disableForeignKeyConstraints();

        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code')->unique();
            $table->unsignedBigInteger('slug');
            $table->decimal('price')->comment('Giá bán');
            $table->decimal('cost_price')->comment('Giá vốn');
            $table->boolean('is_service')->default(false);
            $table->integer('total_stock')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable()->default(null);
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status');
            $table->string('product_id');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('skus');
        Schema::enableForeignKeyConstraints();
    }
};
