<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityEventService;
use App\Services\EventService;
use App\Services\EventUserService;
use App\Services\impl\ActivityEventServiceImpl;
use App\Services\impl\EventServiceServiceimlp;
use App\Services\impl\EventServiceImpl;
use App\Services\impl\EventUserServiceimpl;
use App\Services\MessagesService;
use App\Services\impl\MessagesServiceimpl;
use App\Services\NotificationService;
use App\Services\impl\NotificationServiceimpl;
use App\Services\PaymentService;
use App\Services\impl\PaymentServiceimpl;
use App\Services\impl\RoleServiceimpl;
use App\Services\impl\SecurityEventsServiceimpl;
use App\Services\RoleService;
use App\Services\SecurityEventsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventService::class, EventServiceImpl::class);
        $this->app->bind(ActivityEventService::class, ActivityEventServiceImpl::class);
        $this->app->bind(EventUserService::class, EventUserServiceimpl::class);
        $this->app->bind(MessagesService::class, MessagesServiceimpl::class);
        $this->app->bind(NotificationService::class, NotificationServiceimpl::class);
        $this->app->bind(PaymentService::class, PaymentServiceimpl::class);
        $this->app->bind(RoleService::class, RoleServiceimpl::class);
        $this->app->bind(SecurityEventsService::class, SecurityEventsServiceimpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
