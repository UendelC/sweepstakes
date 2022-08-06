<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Sweepstake extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number_of_winners',
        'end_date',
        'description',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    public static function boot(): void
    {
        parent::boot();

        static::creating(static function (Model $model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }
}
