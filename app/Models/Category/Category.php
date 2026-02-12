<?php

namespace App\Models\Category;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Category extends Model
{

    protected $fillable = ['name', 'slug'];

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }

    protected static function booted()
    {
        static::creating(function($category){
            if(empty($category->slug)){
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function($category){
            if($category->isDirty('name') && !$category->isDirty('slug')){
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function scopeFilter(Builder $query, array $filters)
{
    return $query->when($filters['search'] ?? null, function ($q, $search) {
        $q->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('slug', 'LIKE', "%$search%");
        });
    });
}
}
