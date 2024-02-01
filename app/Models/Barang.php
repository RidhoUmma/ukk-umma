<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'tbl_barang';

    protected $fillable = [
        'id_jenis',
        'kode_barang',
        'name_barang',
        'harga_beli',
        'harga_jual',
        'stok',
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->kode_barang = 'BRG' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        });
    }
}
