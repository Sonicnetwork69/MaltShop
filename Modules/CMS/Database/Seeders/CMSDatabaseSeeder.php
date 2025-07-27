<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CMS\Database\Seeders\AdminMenusTableSeeder;
use Modules\CMS\Database\Seeders\TemplateAndLayoutSeeder;
use Modules\CMS\Database\Seeders\versions\v1_2_0\{
    PagesTableSeeder as Pages,
    SlidersTableSeeder as Sliders,
    ThemeOptionsTableSeeder as Themes,
};

class CMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PageTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(AdminMenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(ThemeOptionsTableSeeder::class);
        $this->call(TemplateAndLayoutSeeder::class);
        $this->call(ComponentsTableSeeder::class);
        $this->call(ComponentPropertiesTableSeeder::class);
        $this->call(Sliders::class);
        $this->call(Themes::class);
        $this->call(Pages::class);
    }
}
