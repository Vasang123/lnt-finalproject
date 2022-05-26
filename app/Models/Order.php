<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $fillable = [
        'kode_user',
        'kode_pos',
        'status',
        'message',
        'random_code',
        'address',
        'total_price'
    ];

}
