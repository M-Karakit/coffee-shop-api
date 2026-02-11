<?php

namespace App\Models\Tag;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{

    protected $fillable = ['name', 'slug'];

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
