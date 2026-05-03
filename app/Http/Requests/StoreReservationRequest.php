<?php

namespace App\Http\Requests;

use App\Models\Trajet;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50', 'regex:/^[0-9+\s\-]{8,20}$/'],
            'seats_reserved' => ['required', 'integer', 'min:1'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            $trajet = $this->route('trajet');
            if (! $trajet instanceof Trajet) {
                return;
            }

            if (! $trajet->isBookable()) {
                $validator->errors()->add('trajet', __('Ce trajet n\'est plus disponible à la réservation.'));

                return;
            }

            $seats = (int) $this->input('seats_reserved', 0);
            if ($seats > $trajet->seats_available) {
                $validator->errors()->add(
                    'seats_reserved',
                    __('Le nombre de places demandées dépasse la disponibilité (:max).', ['max' => $trajet->seats_available])
                );
            }
        });
    }
}
