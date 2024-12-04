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
            $table->tinyInteger('tinyint_col');
            $table->smallInteger('smallint_col');
            $table->mediumInteger('mediumint_col');
            $table->integer('int_col');
            $table->integer('bigint_col');
            $table->decimal('decimal_col')->nullable();
            $table->string('NOT')->nullable();
            $table->float('float_col');
            $table->double('double_col');
            $table->string('char_col');
            $table->string('varchar_col');
            $table->text('text_col');
            $table->binary('blob_col')->nullable();
            $table->date('date_col');
            $table->date('datetime_col');
            $table->timestamp('timestamp_col')->nullable();
            $table->time('time_col');
            $table->year('year_col');
            $table->json('json_col')->nullable();
            $table->geometry('spatial_col')->nullable();
            
            
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