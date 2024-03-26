<?php

namespace App\Providers;
use App\Models\CategoriesModel;
use App\Policies\CategoryPolicy;
use App\Models\ProductModel;
use App\Policies\ProductPolicy;
use App\Models\BlogModel;
use App\Models\OrderModel;
use App\Policies\BlogPolicy;
use App\Models\SettingModel;
use App\Policies\SettingPolicy;
use App\Models\SlideModel;
use App\Models\User;
use App\Policies\OrderPolicy;
use App\Policies\SlidePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\HasApiTokens;


class AuthServiceProvider extends ServiceProvider
{
    use HasApiTokens;
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        CategoriesModel::class => CategoryPolicy::class,
        ProductModel::class => ProductPolicy::class,
        BlogModel::class => BlogPolicy::class,
        SettingModel::class => SettingPolicy::class,
        SlideModel::class => SlidePolicy::class,
        User::class => UserPolicy::class,
        OrderModel::class => OrderPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('list-category', [CategoryPolicy::class , 'viewAny']);
        Gate::define('add-category', [CategoryPolicy::class , 'create']);
        Gate::define('edit-category', [CategoryPolicy::class , 'update']);
        Gate::define('delete-category', [CategoryPolicy::class , 'delete']);

        Gate::define('list-product', [ProductPolicy::class , 'viewAny']);
        Gate::define('add-product', [ProductPolicy::class , 'create']);
        Gate::define('edit-product', [ProductPolicy::class , 'update']);
        Gate::define('delete-product', [ProductPolicy::class , 'delete']);

        Gate::define('list-blog', [BlogPolicy::class , 'viewAny']);
        Gate::define('add-blog', [BlogPolicy::class , 'create']);
        Gate::define('edit-blog', [BlogPolicy::class , 'update']);
        Gate::define('delete-blog', [BlogPolicy::class , 'delete']);


        Gate::define('list-setting', [SettingPolicy::class , 'viewAny']);
        Gate::define('add-setting', [SettingPolicy::class , 'create']);
        Gate::define('edit-setting', [SettingPolicy::class , 'update']);
        Gate::define('delete-setting', [SettingPolicy::class , 'delete']);



        Gate::define('list-slide', [SlidePolicy::class , 'viewAny']);
        Gate::define('add-slide', [SlidePolicy::class , 'create']);
        Gate::define('edit-slide', [SlidePolicy::class , 'update']);
        Gate::define('delete-slide', [SlidePolicy::class , 'delete']);

        Gate::define('list-user', [UserPolicy::class , 'viewAny']);
        Gate::define('add-user', [UserPolicy::class , 'create']);
        Gate::define('edit-user', [UserPolicy::class , 'update']);
        Gate::define('delete-user', [UserPolicy::class , 'delete']);


        
        Gate::define('list-order', [OrderPolicy::class , 'viewAny']);
        Gate::define('edit-order', [OrderPolicy::class , 'view']);
        Gate::define('list-role', [OrderPolicy::class , 'create']);
    }
}
