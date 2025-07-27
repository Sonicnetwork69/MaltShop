<?php

namespace Database\Seeders\versions\v1_1_0;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('categories')->whereIn('slug', [
            'sports--outdoor', 'laptops', 'camera-accessories', 'virtual-reality', 'shoes-', 'clothing'
            ])->update(['product_counts' => 0]);
    }
}
