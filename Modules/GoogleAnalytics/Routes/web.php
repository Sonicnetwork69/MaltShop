<?php

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

use Illuminate\Support\Facades\Route;
use Modules\GoogleAnalytics\Http\Controllers\{
    GoogleAnalyticsController,
    GoogleAnalyticsSettingController
};

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'locale', 'permission']], function () {

    Route::get('analytics-dashboard', [GoogleAnalyticsController::class, 'dashboard'])->name('analytics.dashboard');
    Route::get('top-visited-pages', [GoogleAnalyticsController::class, 'topVisitedPage'])->name('top.visited.page');
    Route::get('most-visited-country', [GoogleAnalyticsController::class, 'mostVisitedCountry'])->name('most.visited.country');

    Route::get('analytics-settings', [GoogleAnalyticsSettingController::class, 'settings'])->name('analytics.settings');
    Route::post('analytics-settings', [GoogleAnalyticsSettingController::class, 'settingsStore'])->middleware(['checkForDemoMode'])->name('analytics.settings.store');

    Route::get('audience', [GoogleAnalyticsController::class, 'audience'])->name('audience');
    Route::get('location', [GoogleAnalyticsController::class, 'location'])->name('location');
    Route::get('page_view', [GoogleAnalyticsController::class, 'pageView'])->name('page_view');
    Route::get('visitor', [GoogleAnalyticsController::class, 'visitor'])->name('visitor');
    Route::get('device', [GoogleAnalyticsController::class, 'device'])->name('device');
    Route::get('active_user', [GoogleAnalyticsController::class, 'user'])->name('active_user');
});