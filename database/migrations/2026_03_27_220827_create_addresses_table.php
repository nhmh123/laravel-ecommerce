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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable'); 
            $table->enum('type', ['home', 'office', 'shipping', 'billing'])->default('shipping');
            $table->boolean('is_default')->default(false);
            $table->string('province_id')->nullable();
            $table->string('ward_id')->nullable();
            $table->text('address_detail')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
