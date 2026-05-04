<?php

namespace App\Http\Requests;

use App\Support\MoroccanCities;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchTrajetsRequest extends FormRequest
{
    protected $redirectRoute = 'home';

    public function authorize(): bool
    {
        return true;
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
            'date' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'arrival_city.different' => __('La ville d\'arrivée doit être différente du départ.'),
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
