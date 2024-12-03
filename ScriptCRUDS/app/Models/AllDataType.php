<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllDataType extends Model
{
    use HasFactory;

    protected $table = 'all_data_types'; // Tabla asociada

    protected $fillable = [
        'id',
        'tinyint_col',
        'smallint_col',
        'mediumint_col',
        'int_col',
        'bigint_col',
        'decimal_col',
        'NOT',
        'float_col',
        'double_col',
        'char_col',
        'varchar_col',
        'text_col',
        'blob_col',
        'date_col',
        'datetime_col',
        'timestamp_col',
        'time_col',
        'year_col',
        'enum_col',
        'set_col',
        'NOT',
        'json_col',
        'spatial_col'
    ];

    
}