<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    
    protected $table = 'cost'; // Nama tabel dalam database

    protected $fillable = [
        'projectID',
        'assortment',
        'productID',
        'category',
        'material',
        'cost',
        'labor',
        'total',
        'remarks',
    ];


}
