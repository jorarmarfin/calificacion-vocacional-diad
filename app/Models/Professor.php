<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Professor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'question',
        'code',
        'prefix',
        'names',
        'email',
        'phone',
        'active',
    ];
    //relation to user
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
