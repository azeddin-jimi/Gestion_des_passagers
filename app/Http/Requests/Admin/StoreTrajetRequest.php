<?php

namespace App\Http\Requests\Admin;

use App\Support\MoroccanCities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTrajetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $cities = MoroccanCities::all();

        return [
            'departure_city' => ['required', 'string', 'max:120', Rule::in($cities)],
            'arrival_city' => ['required', 'string', 'max:120', Rule::in($cities)],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'price' => ['required', 'numeric', 'min:0'],
            'seats_available' => ['required', 'integer', 'min:1'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if (
                $this->filled('departure_city')
                && $this->filled('arrival_city')
                && $this->string('departure_city')->toString() === $this->string('arrival_city')->toString()
            ) {
                $validator->errors()->add('arrival_city', __('La ville d\'arrivée doit être différente du départ.'));
            }
        });
    }
}
