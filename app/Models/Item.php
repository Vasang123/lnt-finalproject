<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'item_image',
        'item_price',
        'item_stock',
        'item_desc',
        'item_type',
    ];
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori', 'item_type', 'id');
    }
}
