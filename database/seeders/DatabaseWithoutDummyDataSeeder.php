<?php

namespace Database\Seeders;

use Database\Seeders\versions\v1_3_0\PreferencesTableSeeder as PreferencesV13TableSeeder;
use Database\Seeders\versions\v1_4_0\PreferencesTableSeeder as PreferencesV14TableSeeder;
use Illuminate\Database\Seeder;

class DatabaseWithoutDummyDataSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrenciesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PreferencesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableWithoutDummyDataSeeder::class);
        $this->call(VendorsTableWithoutDummyDataSeeder::class);
        $this->call(RoleUsersTableWithoutDummyDataSeeder::class);
        $this->call(VendorUsersTableWithoutDummyDataSeeder::class);
        $this->call(CategoriesTableWithoutDummyDataSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(FilesTableWithoutDummyDataSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(OrderStatusRolesTableSeeder::class);
        $this->call(WithdrawalMethodsTableSeeder::class);
        $this->call(ObjectFilesTableWithoutDummyDataSeeder::class);
        $this->call(VendorsMetaTableWithoutDummyDataSeeder::class);
        $this->call(PreferencesV13TableSeeder::class);
        $this->call(PreferencesV14TableSeeder::class);
    }
}
