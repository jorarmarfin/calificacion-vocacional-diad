<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'data',
        'voca',
        'question',
        'note',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'note' => 'integer',
        ];
    }

    /**
     * Get the user that owns the score.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include scores for a specific question.
     */
    public function scopeForQuestion($query, string $question)
    {
        return $query->where('question', $question);
    }

    /**
     * Scope a query to only include scores for a specific voca.
     */
    public function scopeForVoca($query, string $voca)
    {
        return $query->where('voca', $voca);
    }
}
