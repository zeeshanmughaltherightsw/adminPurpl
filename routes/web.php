<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Models\User;

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

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

Route::namespace('App\Http\Controllers\Admin')->group(function(){
    Route::middleware(['auth', 'verified'])->prefix('admin')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::middleware('can:view_settings')->controller(SiteController::class)->group(function(){
            Route::get('/settings', 'getSettings')->name('settings');
            Route::get('/settings/{group}', 'edit')->name('settings.group');
            Route::post('/settings', 'update')->name('settings.group.update');
        });
        
        Route::resource('/manage-plan', PlanController::class)->middleware('can:view_plans');
        Route::get('/manage-plan/status/{plan}', [App\Http\Controllers\Admin\PlanController::class, 'changeStatus'])->middleware('can:edit_plans')->name('manage-plan.status');
        Route::resource('/commission', CommissionController::class);
        Route::get('/add-profit', function () {
            $users = User::withSum(
                ['referrals' => function ($query){
                    $query->where('investment', '>=', 5000);
                }], 'investment')
            ->whereHas('referrals', function($query){
                $query->where('investment', '>=', 5000);
            })->whereStatus('active')->where('user_type', 'user')->get();
            dd($users);
        })->name('add-profit');
    }); // prefix ends 
    
    // Roles
    Route::group(['middleware' => ['can:view_roles'], 'auth'], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('administrators', AdministratorController::class);
        Route::resource('users', App\Http\Controllers\Admin\UsersController::class)->only(['index', 'update', 'edit'])->middleware('can:view_users');
        Route::get('users/transactions/{id}', [App\Http\Controllers\Admin\UsersController::class, 'transactions'])->middleware('can:view_users')->name('users.transactions');
        Route::get('users/status/{id}/{status}', [App\Http\Controllers\Admin\UsersController::class, 'changeStatus'])->middleware('can:edit_users')->name('users.status');
    });
    
});



require __DIR__.'/auth.php';
