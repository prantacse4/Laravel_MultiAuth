<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Implementing Multiauth
#1 Create a project with laravel new multiauth <br/>
#2 In .env file add your database name. <br/>


## Migration
#2 Customize migration for user account add two extra fields or more as per your multi auth. In migration: <br/>
 `$table->boolean('is_user')->default(1);` <br/>
 `$table->boolean('is_admin')->default(0);` <br/>
#1 Run migration command `php artisan migrate` <br/>

## UI Installation for Auth
#1 `composer require laravel/ui` <br/>
#2 `npm install` <br/>
#3 `npm run dev` <br/>
#4 `php artisan ui bootstrap --auth` <br/>


## Multiauth Concept

#1 Now create middleware for your different auth <br/>
-> php artisan make:middleware IsAdmin <br/>
-> php artisan make:middleware IsUser <br/>
#2 In HTTP>Middleware>Karnel.php <br/>
-> `'user' => \App\Http\Middleware\IsUser::class` <br/>
-> `'admin' => \App\Http\Middleware\IsAdmin::class` <br/>
You will use 'user' or 'admin' as your middleware <br/>
#3 Create a view for admnin and user view is created default by Laravel named as Home or you can create also <br/>
#4 Remove middleware part function from HomeController <br/>




## IsAdmin.php (Your created middleware) 
Edit a function <br/>
   public function handle($request, Closure $next)
    {
        
     if (Auth::user() &&  Auth::user()->is_admin == 1) {
            return $next($request);
     }

    return redirect('/');
    }
    
    
## IsUser.php (Your created middleware)
Edit a function (Fitst Condition will return to admin view if your are logged in as admin) <br/>
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



## In web.php you can protect your routes with your custom middleware <br/>
`Route::middleware('admin')->group(function(){` <br/>
    `Route::get('/admin', [AdminController::class, 'admin'])->name('admin');` <br/>
`});` <br/><br/>

`Route::middleware('user')->group(function(){` <br/>
    `Route::get('/home', [HomeController::class, 'index'])->name('home');` <br/>
`});` <br/>





