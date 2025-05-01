<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Models and Policies
use App\Models\Event;
use App\Policies\EventPolicy;

use App\Models\Booking;
use App\Policies\BookingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Event::class => EventPolicy::class,
        Booking::class => BookingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Optionally, define custom gates if needed.
        // Example: Only admin users can perform some action.
        // Gate::define('is-admin', function ($user) {
        //     return $user->role === 'admin';
        // });
    }
}
