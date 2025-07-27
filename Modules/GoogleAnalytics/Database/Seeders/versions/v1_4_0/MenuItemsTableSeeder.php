<?php

namespace Modules\GoogleAnalytics\Database\Seeders\versions\v1_4_0;

use Illuminate\Database\Seeder;
use Modules\MenuBuilder\Http\Models\MenuItems;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $dbMenuItem = MenuItems::where(['label' => 'Google Analytics'])->first();

        if (!$dbMenuItem) {
            $parentId = MenuItems::insertGetId([
                'label' => 'Google Analytics',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 1,
                'icon' => 'fas fa-chart-line',
                'parent' => 0,
                'sort' => 27,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
                'is_custom_menu' => 0,
            ]);

            MenuItems::insert([
                [
                    'label' => 'Dashboard',
                    'link' => 'analytics-dashboard',
                    'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@dashboard", "route_name":["analytics.dashboard"]}',
                    'is_default' => 1,
                    'icon' => NULL,
                    'parent' => $parentId,
                    'sort' => 28,
                    'class' => NULL,
                    'menu' => 1,
                    'depth' => 1,
                    'is_custom_menu' => 0
                ],
                [
                    'label' => 'Visited Pages',
                    'link' => 'top-visited-pages',
                    'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@topVisitedPage", "route_name":["top.visited.page"]}',
                    'is_default' => 1,
                    'icon' => NULL,
                    'parent' => $parentId,
                    'sort' => 29,
                    'class' => NULL,
                    'menu' => 1,
                    'depth' => 1,
                    'is_custom_menu' => 0
                ],
                [
                    'label' => 'Visited Countries',
                    'link' => 'most-visited-country',
                    'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@mostVisitedCountry", "route_name":["most.visited.country"]}',
                    'is_default' => 1,
                    'icon' => NULL,
                    'parent' => $parentId,
                    'sort' => 30,
                    'class' => NULL,
                    'menu' => 1,
                    'depth' => 1,
                    'is_custom_menu' => 0,
                ],
                [
                    'label' => 'Settings',
                    'link' => 'analytics-settings',
                    'params' => '{"permission":"App\\\\Http\\\\Controllers\\\\GoogleAnalyticsController@settings", "route_name":["analytics.settings"]}',
                    'is_default' => 1,
                    'icon' => NULL,
                    'parent' => $parentId,
                    'sort' => 31,
                    'class' => NULL,
                    'menu' => 1,
                    'depth' => 1,
                    'is_custom_menu' => 0,
                ]
            ]);
        }
    }
}
