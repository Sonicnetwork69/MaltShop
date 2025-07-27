<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\versions\{
  v1_1_0\DatabaseSeeder as V11DatabaseSeeder,
  v1_2_0\DatabaseSeeder as V12DatabaseSeeder,
  v1_3_0\DatabaseSeeder as V13DatabaseSeeder,
  v1_4_0\DatabaseSeeder as V14DatabaseSeeder,
  v1_5_0\DatabaseSeeder as V15DatabaseSeeder,
  v1_6_0\DatabaseSeeder as V16DatabaseSeeder,
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        if (class_exists(EmailConfigurationsTableSeeder::class)) {
            $this->call(EmailConfigurationsTableSeeder::class);
        }
        $this->call(LanguagesTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PreferencesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);
        $this->call(VendorUsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(AttributeGroupsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(AttributeValuesTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(WishlistsTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(FilesTableSeeder::class);
        $this->call(ProductCrossSalesTableSeeder::class);
        $this->call(ProductRelatesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ProductTagsTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(OrderStatusRolesTableSeeder::class);
        $this->call(CategoryAttributesTableSeeder::class);
        $this->call(WithdrawalMethodsTableSeeder::class);
        $this->call(UserWithdrawalSettingsTableSeeder::class);
        $this->call(ObjectFilesTableSeeder::class);
        $this->call(ProductsMetaTableSeeder::class);
        $this->call(ProductUpsalesTableSeeder::class);
        $this->call(ProductCouponsTableSeeder::class);
        $this->call(FlashSalesTableSeeder::class);
        $this->call(UsersMetaTableSeeder::class);
        $this->call(VendorsMetaTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderStatusHistoriesTableSeeder::class);
        $this->call(OrdersMetaTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(OrderCommissionsTableSeeder::class);
        $this->call(BrandStatsTableSeeder::class);
        $this->call(CategoryStatsTableSeeder::class);
        $this->call(PaymentLogsTableSeeder::class);
        $this->call(ProductStatsTableSeeder::class);
        $this->call(WalletsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);

        $this->call(V11DatabaseSeeder::class);
        $this->call(V12DatabaseSeeder::class);
        $this->call(V13DatabaseSeeder::class);
        $this->call(V14DatabaseSeeder::class);
        $this->call(V15DatabaseSeeder::class);
        $this->call(V16DatabaseSeeder::class);
    }
}
