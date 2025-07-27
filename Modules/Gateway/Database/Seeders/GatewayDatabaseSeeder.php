<?php

namespace Modules\Gateway\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GatewayDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        if (class_exists(GatewaysTableSeeder::class)) {
            $this->call(GatewaysTableSeeder::class);
        } else {
            $this->call(GatewaysTableWithoutDummyDataSeeder::class);
        }

    }
}
