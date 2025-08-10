<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'order_date',
        'delivery_date',
        'status',
    ];

    protected $casts = [
        'order_date'    => 'datetime:d/m/Y H:i:s',
        'delivery_date' => 'datetime:d/m/Y H:i:s',
        'status'        => OrderStatus::class,
        'created_at'    => 'datetime:d/m/Y H:i:s',
        'updated_at'    => 'datetime:d/m/Y H:i:s',
    ];
}
