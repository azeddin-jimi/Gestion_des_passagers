<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
    /**
     * Switch the application language
     */
    public function setLanguage(string $locale): RedirectResponse
    {
        // Validate the locale is supported
        $supportedLocales = ['en', 'fr', 'ar'];

        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.locale');
        }

        // Store locale in session
        session(['locale' => $locale]);

        // Set the app locale
        app()->setLocale($locale);

        // Store preference in cookie (optional - for persistent language selection)
        cookie('locale', $locale, 60 * 60 * 24 * 365); // 1 year

        // Redirect back to the previous page
        return back();
    }
}
