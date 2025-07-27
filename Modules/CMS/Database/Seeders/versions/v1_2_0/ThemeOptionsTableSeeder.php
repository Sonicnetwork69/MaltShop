<?php

namespace Modules\CMS\Database\Seeders\versions\v1_2_0;

use App\Models\File;
use Illuminate\Database\Seeder;
use Modules\CMS\Http\Models\ThemeOption;
use Modules\MediaManager\Http\Models\ObjectFile;

class ThemeOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {

        $dbPaymentLogo = File::where(['file_name' => '20230507/0e705ad6e849d5118b9d7ee06bae8ac9.png'])->first();

        if ($dbPaymentLogo) {
            $paymentLogoId = $dbPaymentLogo->id;
        } else {
            $paymentLogoId = File::insertGetId([
                'params' => '{"size":16.1826171875,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230507/0e705ad6e849d5118b9d7ee06bae8ac9.png',
                'file_size' => 16.18,
                'original_file_name' => 'Frame 94913.png',
            ]);
        }

        $dbFooterLogo = File::where(['file_name' => '20230508/eee1c999851b738e2646361b44370fec.png'])->first();

        if ($dbFooterLogo) {
            $footerLogoId = $dbFooterLogo->id;
        } else {
            $footerLogoId = File::insertGetId([
                'params' => '{"size":3.666015625,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230508/eee1c999851b738e2646361b44370fec.png',
                'file_size' => 3.67,
                'original_file_name' => 'martvill-logo (7).png',
            ]);
        }

        $dbThemeOption = ThemeOption::where('name', 'like', 'fashion_v5_template_%')->first();

        if (!$dbThemeOption) {
            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_footer_logo',
                'value' => '1167',
            ]);

            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $footerLogoId,
            ]);

            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_google_play',
                'value' => '',
            ]);

            $file = File::where('file_name', 'like', '20220803/04c5dd8f473f1ba24184d750355d0f06%')->first();

            $fileId = $file?->id ?? $footerLogoId;

            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $fileId,
            ]);

            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_app_store',
                'value' => '',
            ]);

            $file = File::where('file_name', 'like', '20220803/eb0d5577d653c151b73eed36b9ad150f%')->first();

            $fileId = $file?->id ?? $footerLogoId;

            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $fileId,
            ]);


            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_payment_methods',
                'value' => '',
            ]);
            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $paymentLogoId,
            ]);

            ThemeOption::insert([
                [
                    'name' => 'fashion_v5_template_phone_no',
                    'value' => '0',
                ], [
                    'name' => 'fashion_v5_template_email',
                    'value' => '0',
                ], [
                    'name' => 'fashion_v5_template_currency',
                    'value' => '0',
                ], [
                    'name' => 'fashion_v5_template_footer',
                    'value' => '{"main":{"text_color":"#2c2c2c","bg_color":"#f2f3f5","direction":"center","about_us":{"sort":"1","status":"1","title":"About Us","data":{"short_details":"The ultimate all-in-one solution for your ecommerce business worldwide.","download_app":"Download Our App","google_play_link":"https:\\/\\/play.google.com\\/store\\/games","app_store_link":"https:\\/\\/www.apple.com\\/app-store\\/"}},"useful_links":{"sort":"2","status":"0","title":"Useful Links","data":{"1":{"label":"About Us","link":"' . url('/') . '/page\\/about-us"},"2":{"label":"Contact Us","link":"' . url('/') . '/page\\/contact-us"},"3":{"label":"Privacy Policy","link":"' . url('/') . '/page\\/privacy-policy"},"4":{"label":"Refund Policy","link":"' . url('/') . '/page\\/refund-policy"},"5":{"label":"Digital Payment","link":"' . url('/') . '/page\\/digital-payments"},"6":{"label":"Track Order","link":"' . url('/') . '/track-order"},"7":{"label":"All Products","link":"' . url('/') . '/search-products"},"8":{"label":"Be A Seller","link":"' . url('/') . '/seller\\/sign-up"}}},"pages":{"sort":"3","status":"1","title":"Home Pages","data":{"1":{"label":"Homepage - Mixed","link":"' . url('/') . '/page\\/home-1"},"2":{"label":"Homepage - Furniture","link":"' . url('/') . '/page\\/home-3"},"3":{"label":"Homepage - Digital Product","link":"' . url('/') . '/page\\/home-6"},"4":{"label":"Homepage - Groceries","link":"' . url('/') . '/page\\/home-7"},"5":{"label":"Homepage - Fashion - I","link":"' . url('/') . '/page\\/home-8"},"6":{"label":"Homepage - Fashion - II","link":"' . url('/') . '/page\\/home-5"},"7":{"label":"Homepage - Fashion - III","link":"' . url('/') . '/page\\/home-2"},"8":{"label":"Homepage - Fashion - IV","link":"' . url('/') . '/page\\/home-4"}}},"categories":{"sort":"4","status":"0","title":"Categories","data":{"1":{"label":"Electronics Devices","link":"' . url('/') . '/search-products?categories=Electronic%20Devices"},"2":{"label":"Electronics Accessories","link":"' . url('/') . '/search-products?categories=Electronic%20Accessories"},"3":{"label":"Health and Beauty","link":"' . url('/') . '/search-products?categories=Health%20%26%20Beauty"},"4":{"label":"Babies and Toys","link":"' . url('/') . '/search-products?categories=Babies%20%26%20Toys"},"5":{"label":"Fashion for All","link":"' . url('/') . '/search-products?categories=Fashion"},"6":{"label":"Watches & Accessories","link":"' . url('/') . '/search-products?categories=Watches%20%26%20Accessories"},"7":{"label":"Sports and Outdoor","link":"' . url('/') . '/search-products?categories=Sports%20%26%20Outdoor"},"8":{"label":"Automobile & Bicycles","link":"' . url('/') . '/search-products?categories=Automotive%20%26%20Motorbike"}}},"contact_us":{"sort":"5","status":"1","title":"Contact Us","data":{"address":"Address: 184 Main Rd E, St Albans, Australia","email":"admin@techvill.net","phone":"+12013828901","social_title":"Stay Connected","social_data":{"1":{"label":"facebook","link":"https:\\/\\/www.facebook.com"},"2":{"label":"youtube","link":"https:\\/\\/www.youtube.com"},"3":{"label":"whatsapp","link":""},"4":{"label":"instagram","link":"https:\\/\\/www.instagram.com"},"5":{"label":"wechat","link":""},"6":{"label":"tiktok","link":""},"7":{"label":"telegram","link":""},"8":{"label":"snapchat","link":""},"9":{"label":"twitter","link":"https:\\/\\/www.twitter.com"},"10":{"label":"reddit","link":""},"11":{"label":"quora","link":""},"12":{"label":"skype","link":""},"13":{"label":"microsoft_teams","link":""},"14":{"label":"linkedin","link":"https:\\/\\/www.linkedin.com"}}}}},"bottom":{"status":"1","text_color":"#ffffff","bg_color":"#2c2c2c","border_top":"#050505","title":"\\u00a92023 Mart Vill | All Rights Reserved","position":"center"}}',
                ], [
                    'name' => 'fashion_v5_template_header',
                    'value' => '{"top":{"show_header":"0","text_color":"#2c2c2c","bg_color":"#fcca19","show_phone":"1","phone":"+12013828902","show_email":"1","email":"admin@techvill.net","show_seller":"1","show_compare":"1","show_currency":"1","show_language":"1"},"main":{"text_color":"#2c2c2c","bg_color":"#ffffff","show_logo":"1","show_searchbar":"1","show_account":"1","show_wishlist":"1","show_cart":"1","show_track":"0"},"bottom":{"text_color":"#2c2c2c","bg_color":"#ffffff","show_category":"0","category_expand":"1","border_top":"#dfdfdf","border_bottom":"#dfdfdf","show_page_menu":"0","show_download_app":"0","show_google_play":"1","google_play_link":"https:\\/\\/play.google.com\\/store\\/games","show_app_store":"1","app_store_link":"https:\\/\\/www.apple.com\\/app-store\\/"},"bottom_category":{"text_color":"#2c2c2c","bg_color":"#f3f3f3"}}',
                ],
            ]);

            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_header_logo',
                'value' => '1167',
            ]);
            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $footerLogoId,
            ]);

            ThemeOption::insert([
                [
                    'name' => 'fashion_v5_template_is_color_picker_active',
                    'value' => '0',
                ], [
                    'name' => 'fashion_v5_template_social',
                    'value' => '{"facebook":"1","whatsapp":"1","instagram":"1","pinterest":"1","linkedin":"1"}',
                ], [
                    'name' => 'fashion_v5_template_page',
                    'value' => '{"term_condition":"privacy-policy","slider":"home-page"}',
                ]

            ]);

            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_header_mobile_logo',
                'value' => '1167',
            ]);

            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $footerLogoId,
            ]);

            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_download_google_play_logo',
                'value' => '',
            ]);

            $file = File::where('file_name', 'like', '20220904/b62712ef7733ddd98f49ac39385c339e%')->first();

            $fileId = $file?->id ?? $footerLogoId;

            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $fileId,
            ]);
            $themeId = ThemeOption::insertGetId([
                'name' => 'fashion_v5_template_download_app_store_logo',
                'value' => '',
            ]);

            $file = File::where('file_name', 'like', '20220904/06afe32505afa6003915b5b2934f51e7%')->first();

            $fileId = $file?->id ?? $footerLogoId;

            ObjectFile::insert([
                'object_type' => 'theme_options',
                'object_id' => $themeId,
                'file_id' => $fileId,
            ]);

            ThemeOption::insert([
                [
                    'name' => 'fashion_v5_template_primary_color',
                    'value' => '#19c880',
                ], [
                    'name' => 'fashion_v5_template_product',
                    'value' => '{"add_to_cart":"1","wishlist":"1","compare":"1","quick_view":"1","review":"1","price":"1","badge":"1","height":"192"}',
                ]
            ]);
        }

        $dbFontFamily = ThemeOption::where(['name' => 'default_template_font_family'])->first();

        if (!$dbFontFamily) {
            ThemeOption::insert([
                [
                    'name' => 'default_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'fashion_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'groceries_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'mixed_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'fashion_v2_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'fashion_v3_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'furniture_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'fashion_v4_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'digital_template_font_family',
                    'value' => 'DM Sans, sans-serif',
                ], [
                    'name' => 'fashion_v5_template_font_family',
                    'value' => 'Poppins, sans-serif',
                ]

            ]);
        }

    }
}
