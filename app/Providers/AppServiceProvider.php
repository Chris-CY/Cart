<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        try {
            $notifications = Notification::latest()->take(5)->get();
            $order_id = Order::where('status', 'P')->value('id');
            view()->share('cart_id', $order_id);
            view()->share('count_cart', OrderProduct::where('order_id', $order_id)->count());
            view()->share('notifications', $notifications);
            view()->share('count_notifications', $notifications->where('status', 'U')->count());

        } catch (Throwable $e) {
            report($e);
        }

    }
}
