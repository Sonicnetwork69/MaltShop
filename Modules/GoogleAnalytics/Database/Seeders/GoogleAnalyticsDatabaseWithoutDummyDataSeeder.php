<?php

namespace Modules\GoogleAnalytics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\GoogleAnalytics\Database\Seeders\versions\v1_4_0\{
    AdminMenusTableSeeder,
    MenuItemsTableSeeder
};

class GoogleAnalyticsDatabaseWithoutDummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(MenuItemsTableSeeder::class);
        $this->call(AdminMenusTableSeeder::class);
    }
}
