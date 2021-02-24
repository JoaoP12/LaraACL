<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Post;
use App\User;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //\App\Post::class => \App\Policies\PostPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $permissions = Permission::with('roles')->get();
        foreach($permissions as $permission){
            GateContract::define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }

        GateContract::before(function(User $user, $ability){
            if($user->hasAnyRoles('adm')){
                return true;
            }
        });
    }
}
