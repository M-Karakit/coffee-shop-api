<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{

    protected $fillable = ['url', 'imageable'];

    public function imageable(): MorphTo {
        return $this->morphTo();
    }
}
