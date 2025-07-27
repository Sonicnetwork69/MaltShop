<?php

namespace Modules\MenuBuilder\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\MenuBuilder\Database\Seeders\versions\v1_2_0\MenuItemsTableSeeder as MenuItemsV12TableSeeder;

class MenuBuilderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(AdminMenusTableSeeder::class);
        $this->call(MenuItemsV12TableSeeder::class);
    }
}
