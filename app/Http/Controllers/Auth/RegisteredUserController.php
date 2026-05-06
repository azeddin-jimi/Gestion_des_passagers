<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['nullable', 'string', 'max:120'],
            'last_name' => ['nullable', 'string', 'max:120'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $fullName = trim(
            implode(' ', array_filter([
                $request->string('first_name')->toString(),
                $request->string('last_name')->toString(),
            ]))
        );
        $fullName = $fullName !== '' ? $fullName : $request->string('name')->toString();

        $user = User::create([
            'first_name' => $request->string('first_name')->toString() ?: null,
            'last_name' => $request->string('last_name')->toString() ?: null,
            'name' => $fullName,
            'email' => $request->email,
            'whatsapp' => $request->string('whatsapp')->toString() ?: null,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_USER,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect to home page after successful registration
        return redirect(route('home', absolute: false));
    }
}
