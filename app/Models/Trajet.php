<?php

namespace App\Models;

use Database\Factories\TrajetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trajet extends Model
{
    /** @use HasFactory<TrajetFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'departure_city',
        'arrival_city',
        'date',
        'time',
        'price',
        'seats_available',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'price' => 'decimal:2',
        ];
    }

    /**
     * @return HasMany<Reservation, $this>
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function seatsBooked(): int
    {
        return (int) $this->reservations()->sum('seats_reserved');
    }

    public function isBookable(): bool
    {
        return $this->seats_available > 0
            && $this->date->copy()->startOfDay()->gte(now()->startOfDay());
    }
}
