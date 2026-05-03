<x-app-layout>
    <x-slot name="header">
        <h1 class="h4 mb-0 text-secondary">{{ __('Profile') }}</h1>
        <p class="text-muted small mb-0">{{ __('Gérez les informations de votre compte.') }}</p>
    </x-slot>

    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card border-0 shadow-sm border-danger">
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
