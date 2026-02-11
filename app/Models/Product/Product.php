<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use App\Models\Image\Image;
use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'is_active',

    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable');
    }
}
