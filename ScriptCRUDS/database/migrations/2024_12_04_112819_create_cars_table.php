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
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); // Clave primaria automática
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->decimal('price')->nullable();
            $table->string('NOT')->nullable();
            $table->string('color')->nullable();
            $table->integer('stock');
            
            
            $table->timestamps(); // created_at y updated_at automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};