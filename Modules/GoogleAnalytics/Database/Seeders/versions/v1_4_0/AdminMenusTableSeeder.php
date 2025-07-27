<?php

namespace Modules\GoogleAnalytics\Database\Seeders\versions\v1_4_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menus')->upsert([
            [
                'name' => 'Google Analytics',
                'slug' => NULL,
                'url' => NULL,
                'permission' => NULL,
                'is_default' => 1,
            ],
            [
                'name' => 'Dashboard',
                'slug' => 'analytics-dashboard',
                'url' => 'analytics-dashboard',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@dashboard", "route_name":["analytics.dashboard"]}',
                'is_default' => 1,
            ],
            [
                'name' => 'Visited Page',
                'slug' => 'top-visited-pages',
                'url' => 'top-visited-pages',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@topVisitedPage", "route_name":["top.visited.page"]}',
                'is_default' => 1,
            ],
            [
                'name' => 'Visited Countries',
                'slug' => 'most-visited-country',
                'url' => 'most-visited-country',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@mostVisitedCountry", "route_name":["most.visited.country"]}',
                'is_default' => 1,
            ],
            [
                'name' => 'Settings',
                'slug' => 'analytics-settings',
                'url' => 'analytics-settings',
                'permission' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@settings", "route_name":["analytics.settings"]}',
                'is_default' => 1,
            ]

        ], 'slug');
    }
}
