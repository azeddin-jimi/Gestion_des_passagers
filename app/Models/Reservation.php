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
        'payment_method',
        'discount_code',
        'newsletter_opt_in',
        'terms_accepted',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'seats_reserved' => 'integer',
            'newsletter_opt_in' => 'boolean',
            'terms_accepted' => 'boolean',
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
