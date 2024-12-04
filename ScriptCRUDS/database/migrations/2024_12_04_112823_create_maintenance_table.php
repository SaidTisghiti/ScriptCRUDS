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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id(); // Clave primaria automática
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('employee_id');
            $table->text('description');
            $table->date('date');
            $table->decimal('cost')->nullable();
            $table->string('NOT')->nullable();
            
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            
            $table->timestamps(); // created_at y updated_at automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};