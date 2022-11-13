<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Organization;
use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Models\UserRole;
use App\Policies\EventPolicy;
use App\Policies\LocationPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\PersonalAccessTokenPolicy;
use App\Policies\UserPolicy;
use App\Policies\UserRolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Event::class => EventPolicy::class,
        Location::class => LocationPolicy::class,
        Organization::class => OrganizationPolicy::class,
        PersonalAccessToken::class => PersonalAccessTokenPolicy::class,
        User::class => UserPolicy::class,
        UserRole::class => UserRolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
