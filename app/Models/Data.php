<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';
    protected $primaryKey = 'id';

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
        'remarks',
        'image',
        'description',
    ];
    

    // Define the relationship with the Cost model
    public function cost()
    {
        return $this->hasOne(Cost::class, 'projectID', 'projectID');
    }

    public function saveImage($image)
    {
        // Simpan gambar ke penyimpanan yang diinginkan, misalnya folder 'public/images'
        $imageName = $image->store('images', 'public');

        // Simpan nama file gambar ke kolom 'image'
        $this->image = $imageName;
        $this->save();
    }
}
