<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Implementing Multiauth
#1 Create a project with laravel new multiauth
#2 In .env file add your database name.


## Migration
#1 Run migration command 'php artisan migrate'

## UI Installation for Auth
#1 composer require laravel/ui
#2 npm install
#3 npm run dev
#4 php artisan ui bootstrap --auth


## Multiauth Concept

#1 Now create middleware for your different auth
-> php artisan make:middleware IsAdmin
-> php artisan make:middleware IsUser
#2 In HTTP>Middleware>Karnel.php
->'user' => \App\Http\Middleware\IsUser::class
->'admin' => \App\Http\Middleware\IsAdmin::class,
You will use 'user' or 'admin' as your middleware
#3 Create a view for admnin and user view is created default by Laravel named as Home or you can create also
#4 Remove middleware part function from HomeController
#5 Customize migration for user account add two extra fields or more as per your multi auth. In migration:
-> $table->boolean('is_user')->default(1);
-> $table->boolean('is_admin')->default(0);



## IsAdmin.php (Your created middleware)
Edit a function
   public function handle($request, Closure $next)
    {
        
     if (Auth::user() &&  Auth::user()->is_admin == 1) {
            return $next($request);
     }

    return redirect('/');
    }
    
    
## IsUser.php (Your created middleware)
Edit a function (Fitst Condition will return to admin view if your are logged in as admin)
    public function handle($request, Closure $next)
    {

        if (Auth::user() &&  Auth::user()->is_admin == 1) {
            return redirect('/admin');
        }

        if (Auth::user() &&  Auth::user()->is_user == 1) {
            return $next($request);
        }

        return redirect('/');
    }



## In web.php you can protect your routes with your custom middleware
Route::middleware('admin')->group(function(){
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
});

Route::middleware('user')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});





