<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'order_date',
        'delivery_date',
        'status',
    ];

    protected $casts = [
        'order_date'    => 'datetime:d/m/Y H:i:s',
        'delivery_date' => 'datetime:d/m/Y H:i:s',
        'status'        => ProductStatus::class,
        'created_at'    => 'datetime:d/m/Y H:i:s',
        'updated_at'    => 'datetime:d/m/Y H:i:s',
    ];
}
