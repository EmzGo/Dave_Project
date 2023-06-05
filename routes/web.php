<?php

use App\Http\Controllers\Admin\AboutUsPageContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ContactUsPageContentController;
use App\Http\Controllers\Admin\FaqContentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomePageContentController;
use App\Http\Controllers\Admin\HomePageSliderController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'commands'], function () {
    Route::get('/optimize-clear', function() {
        Artisan::call('optimize:clear');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/migrate', function() {
        Artisan::call('migrate');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/clear-compiled', function() {
        Artisan::call('clear-compiled');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/activitylog-clean', function() {
        Artisan::call('activitylog:clean');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/migrate-fresh', function() {
        Artisan::call('migrate:fresh');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/seed', function() {
        Artisan::call('db:seed');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/db-wipe', function() {
        Artisan::call('db:wipe');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/migrate-rollback', function() {
        Artisan::call('migrate:rollback');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });

    Route::get('/permission-cache-reset', function() {
        Artisan::call('permission:cache-reset');
        echo '<pre>'.str_replace('\n', "\n", Artisan::output()).'</pre>';
    });
});


// Route::get('/test', function () {
//     return view('layouts.guest');
// });

Route::get('/admin', [LoginController::class, 'showLoginForm']);

Auth::routes(['verify' => true, 'logout' => false]);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.submit');
        Route::post('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.submit');

        Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
            Route::get('/index', [ScheduleController::class, 'index'])->name('index');
            Route::post('/datatable', [ScheduleController::class, 'datatable'])->name('data');
            Route::get('/register-list', [ScheduleController::class, 'register_index'])->name('register_index');
            Route::post('/register-datatable', [ScheduleController::class, 'register_datatable'])->name('register_datatable');
            Route::get('/add', [ScheduleController::class, 'create'])->name('add');
            Route::post('/exists', [ScheduleController::class, 'exists'])->name('exists');
            Route::post('/store', [ScheduleController::class, 'store'])->name('store');
            Route::get('/view/{id}', [ScheduleController::class, 'show'])->name('view');
            Route::get('/edit/{id}', [ScheduleController::class, 'edit'])->name('edit');
            Route::post('/destroy', [ScheduleController::class, 'destroy'])->name('destroy');
            Route::post('/status/change', [ScheduleController::class, 'statusChange'])->name('status.change');
        });

        Route::group(['prefix' => 'faq-content', 'as' => 'faq_content.'], function () {
            Route::get('/index', [FaqContentController::class, 'index'])->name('index');
            Route::post('/datatable', [FaqContentController::class, 'datatable'])->name('data');
            Route::get('/add', [FaqContentController::class, 'create'])->name('add');
            Route::post('/store', [FaqContentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [FaqContentController::class, 'edit'])->name('edit');
            Route::post('/destroy', [FaqContentController::class, 'destroy'])->name('destroy');
            Route::post('/status/change', [FaqContentController::class, 'statusChange'])->name('status.change');
        });

        Route::group(['prefix' => 'home-page-content', 'as' => 'home_page_content.'], function () {
            Route::get('/', [HomePageContentController::class, 'edit'])->name('edit');
            Route::post('/store', [HomePageContentController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'aboutus-page-content', 'as' => 'aboutus_page_content.'], function () {
            Route::get('/', [AboutUsPageContentController::class, 'edit'])->name('edit');
            Route::post('/store', [AboutUsPageContentController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::post('/exist', [UserController::class, 'exists'])->name('exists');
        });

        Route::group(['prefix' => 'contactus-page-content', 'as' => 'contactus_page_content.'], function () {
            Route::get('/', [ContactUsPageContentController::class, 'edit'])->name('edit');
            Route::post('/store', [ContactUsPageContentController::class, 'store'])->name('store');
            Route::get('/register-list', [ContactUsPageContentController::class, 'register_index'])->name('register_index');
            Route::post('/register-datatable', [ContactUsPageContentController::class, 'register_datatable'])->name('register_datatable');
        });

        Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
            Route::get('/list', [GalleryController::class, 'index'])->name('list');
            Route::post('/datatable', [GalleryController::class, 'datatable'])->name('data');
            Route::post('/store', [GalleryController::class, 'store'])->name('store');
            Route::post('/status/change', [GalleryController::class, 'statusChange'])->name('status.change');
            Route::post('/destroy', [GalleryController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'home-page-slider', 'as' => 'home_page_slider.'], function () {
            Route::get('/list', [HomePageSliderController::class, 'index'])->name('list');
            Route::post('/datatable', [HomePageSliderController::class, 'datatable'])->name('data');
            Route::post('/store', [HomePageSliderController::class, 'store'])->name('store');
            Route::post('/status/change', [HomePageSliderController::class, 'statusChange'])->name('status.change');
            Route::post('/destroy', [HomePageSliderController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::group(['as' => 'front.'], function () {
    Route::get('/', [FrontHomeController::class, 'index'])->name('index');
    Route::get('/schedule/{city?}', [FrontHomeController::class, 'schedule'])->name('schedule');
    Route::get('/schedule-details/{slug}', [FrontHomeController::class, 'schedule_details'])->name('schedule.details');
    Route::post('/schedule-details-register-post', [FrontHomeController::class, 'schedule_register_post'])->name('schedule.register.post');
    Route::get('/completed-schedule/{city?}', [FrontHomeController::class, 'completed_schedule'])->name('completed_schedule');
    Route::get('/gallery', [FrontHomeController::class, 'gallery'])->name('gallery');
    Route::get('/about-us', [FrontHomeController::class, 'about_us'])->name('about_us');
    Route::get('/contact-us', [FrontHomeController::class, 'contact_us'])->name('contact_us');
    Route::post('/contact-us-post', [FrontHomeController::class, 'contact_us_post'])->name('contact_us_post');
});
