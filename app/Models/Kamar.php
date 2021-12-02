<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'm_kamar';

    protected $primaryKey = 'id_kamar';

    protected $guarded = [
        'id_kamar',
    ];

    // protected $fillable = [
    //     'nama_kamar',
    //     'kapasitas',
    //     'luas',
    //     'fasilitas',
    //     'tahunan',
    //     'bulanan',
    //     'mingguan',
    //     'harian',
    // ];

    public $timestamps = false;
}
