<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActivityEventService;
use App\Services\EventService;
use App\Services\EventUserService;
use App\Services\FeedbackService;
use App\Services\impl\ActivityEventServiceImpl;
use App\Services\impl\EventServiceImpl;
use App\Services\impl\EventUserServiceImpl;
use App\Services\impl\FeedbackServiceImpl;
use App\Services\MessagesService;
use App\Services\impl\MessagesServiceImpl;
use App\Services\NotificationService;
use App\Services\impl\NotificationServiceImpl;
use App\Services\PaymentService;
use App\Services\impl\PaymentServiceImpl;
use App\Services\impl\RoleServiceImpl;
use App\Services\impl\SecurityEventsServiceImpl;
use App\Services\RoleService;
use App\Services\SecurityEventsService;
use App\Services\UserService;
use App\Services\impl\UserServiceImpl;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventService::class, EventServiceImpl::class);
        $this->app->bind(ActivityEventService::class, ActivityEventServiceImpl::class);
        $this->app->bind(EventUserService::class, EventUserServiceImpl::class);
        $this->app->bind(FeedbackService::class, FeedbackServiceImpl::class);
        $this->app->bind(MessagesService::class, MessagesServiceImpl::class);
        $this->app->bind(NotificationService::class, NotificationServiceImpl::class);
        $this->app->bind(PaymentService::class, PaymentServiceImpl::class);
        $this->app->bind(RoleService::class, RoleServiceImpl::class);
        $this->app->bind(SecurityEventsService::class, SecurityEventsServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
