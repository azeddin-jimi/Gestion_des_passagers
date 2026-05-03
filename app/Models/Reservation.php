<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'trajet_id',
        'name',
        'phone',
        'seats_reserved',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'seats_reserved' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Trajet, $this>
     */
    public function trajet(): BelongsTo
    {
        return $this->belongsTo(Trajet::class);
    }
}
