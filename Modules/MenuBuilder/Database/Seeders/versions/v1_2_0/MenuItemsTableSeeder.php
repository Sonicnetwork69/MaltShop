<?php

namespace Modules\MenuBuilder\Database\Seeders\versions\v1_2_0;

use Illuminate\Database\Seeder;
use Modules\MenuBuilder\Http\Models\MenuItems;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {
        $menu = MenuItems::where(['link' => 'page/home-10', 'menu' => 4])->first();

        if ($menu) {
            MenuItems::insert([
                'label' => 'Home 10',
                'link' => 'page/home-10',
                'params' => '{"permission":"no-prefix"}',
                'is_default' => 0,
                'icon' => NULL,
                'parent' => $menu->id,
                'sort' => 10,
                'class' => NULL,
                'menu' => 4,
                'depth' => 1,
                'is_custom_menu' => 1,
            ]);
        }
    }
}
