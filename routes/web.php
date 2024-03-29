<?php
use App\Models\User;
use App\Models\Reward;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserRewardsController;
use App\Http\Controllers\Admin\WithdrawalsController;

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
    Route::middleware(['auth', 'verified'])->group(function(){

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::middleware('can:view_settings')->controller(SiteController::class)->group(function(){
            Route::get('/settings', 'getSettings')->name('settings');
            Route::get('/settings/{group}', 'edit')->name('settings.group');
            Route::post('/settings', 'update')->name('settings.group.update');
        });
        
        Route::resource('/manage-plan', PlanController::class)->middleware('can:view_plans');
        Route::get('/manage-plan/status/{plan}', [PlanController::class, 'changeStatus'])->middleware('can:edit_plans')->name('reward.status');
        Route::resource('/reward', RewardController::class)->middleware('can:view_reward');
        Route::get('/reward/status/{reward}', [RewardController::class, 'changeStatus'])->middleware('can:edit_reward')->name('reward.status');
        Route::resource('/commission', CommissionController::class)->middleware('can:view_commission');
        Route::resource('{type}/gateway', GatewayController::class)->middleware('can:view_gateway');
        Route::resource('withdrawals', WithdrawalsController::class)->middleware('can:view_withdrawal');
        Route::resource('rewards', UserRewardsController::class)->middleware('can:view_user_rewards');
        Route::resource('users', App\Http\Controllers\Admin\UsersController::class)->only(['index', 'update', 'edit'])->middleware('can:view_users');
        Route::post('user/{user}/', [App\Http\Controllers\Admin\UsersController::class, 'subscribePlan'])->middleware('can:view_users')->name('subscribe-plan');
        Route::get('users/transactions/{id}', [App\Http\Controllers\Admin\UsersController::class, 'transactions'])->middleware('can:view_users')->name('users.transactions');
        Route::get('users/status/{id}/{status}', [App\Http\Controllers\Admin\UsersController::class, 'changeStatus'])->middleware('can:edit_users')->name('users.status');

    
    // Roles
    Route::group(['middleware' => ['can:view_roles'], 'auth'], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('administrators', AdministratorController::class);
    });
    
});
});


require __DIR__.'/auth.php';
