<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Configuration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'names',
        'value',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get a configuration value by key.
     */
    public static function getValue(string $key, mixed $default = null): mixed
    {
        $config = static::where('key', $key)->first();
        return $config?->value ?? $default;
    }

    /**
     * Set a configuration value by key.
     */
    public static function setValue(string $key, string $names, mixed $value): Configuration
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['names' => $names, 'value' => $value]
        );
    }
    public function scopeCodigo(Builder $query,$codigo): void
    {
        $query->where('key',  $codigo);
    }
}
