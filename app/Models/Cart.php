<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['kode_user', 'kode_produk', 'jumlah'];

    public function items()
    {
        return $this->belongsTo('App\Models\Item', 'kode_produk', 'id');
    }
}
