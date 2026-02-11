<?php

namespace App\Models\Order;

use App\Models\OrderItem\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $fillable = ['user_id', 'status', 'total_amount'];

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class);
    }
}
