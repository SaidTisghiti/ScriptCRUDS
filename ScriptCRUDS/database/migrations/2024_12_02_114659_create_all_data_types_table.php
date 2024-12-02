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
        Schema::create('all_data_types', function (Blueprint $table) {
            $table->id(); // Clave primaria automática
            $table->string('tinyint_col');
            $table->string('smallint_col');
            $table->string('mediumint_col');
            $table->string('int_col');
            $table->string('bigint_col');
            $table->string('decimal_col')->nullable();
            $table->string('NOT')->nullable();
            $table->string('float_col');
            $table->string('double_col');
            $table->string('char_col');
            $table->string('varchar_col');
            $table->string('text_col');
            $table->string('blob_col')->nullable();
            $table->string('date_col');
            $table->string('datetime_col');
            $table->string('timestamp_col')->nullable();
            $table->string('time_col');
            $table->string('year_col');
            $table->string('json_col')->nullable();
            $table->string('spatial_col')->nullable();
            
            
            $table->timestamps(); // created_at y updated_at automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_data_types');
    }
};