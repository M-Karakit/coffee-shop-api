<?php

namespace App\Models\UserProfile;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserProfile extends Model
{

    protected $fillable = [
        'user_id',
        'phone',
        'address',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
