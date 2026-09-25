<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Izinkan kolom-kolom finansial ini diisi secara otomatis oleh sistem pembeli
    protected $fillable = [
        'invoice_id', 
        'user_id', 
        'game_name', 
        'zone_id', 
        'product_name', 
        'price', 
        'cost_price', 
        'profit', 
        'payment_method',
        'status'
    ];
}
