<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonalAccessTokenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->group(static function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::model('personal_access_token', PersonalAccessToken::class);
    Route::resource('personal-access-tokens', PersonalAccessTokenController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    Route::model('user', User::class);
    Route::resource('users', UserController::class)
        ->only(['index', 'create', 'store', 'edit', 'update']);

    Route::model('user_role', UserRole::class);
    Route::resource('user-roles', UserRoleController::class)
        ->only(['index', 'create', 'store', 'edit', 'update']);

    // My Account
    Route::get('account', [AccountController::class, 'edit'])
        ->name('account.edit');
    Route::put('account', [AccountController::class, 'update'])
        ->name('account.update');
});

require __DIR__ . '/auth.php';
