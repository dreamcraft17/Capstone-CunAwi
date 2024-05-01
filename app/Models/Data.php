<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data'; // Nama tabel dalam database

    protected $fillable = [
        'projectID',
        'assortment',
        'productID',
        'toyName',
        'category',
        'designer',
        'pe',
        'meeting',
        'start_date',
        'month',
        'finish_cmt',
        'finish_act',
        'adherence',
        'status',
        'lead_time',
        'remarks',
        'image',
        'description',
    ];

    // Jika Anda tidak ingin menggunakan timestamps (created_at dan updated_at), Anda dapat menonaktifkannya
    public $timestamps = false;
}
