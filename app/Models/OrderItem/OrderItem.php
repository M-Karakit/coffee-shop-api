<?php

namespace App\Models\OrderItem;

use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_at_time',
    ];

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }
}
