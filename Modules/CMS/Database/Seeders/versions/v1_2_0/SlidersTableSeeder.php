<?php

namespace Modules\CMS\Database\Seeders\versions\v1_2_0;

use App\Models\File;
use Illuminate\Database\Seeder;
use Modules\CMS\Http\Models\{
    Slide, Slider
};
use Modules\MediaManager\Http\Models\ObjectFile;

class SlidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $url = url('/');
        $dbSlider = Slider::where(['slug' => 'fashion-v5-primary'])->first();

        if (!$dbSlider) {
            $sliderId = Slider::insertGetId([
                'name' => 'Fashion V5 Primary',
                'slug' => 'fashion-v5-primary',
                'status' => 'Active'
            ]);

            $slideId = Slide::insertGetId([
                'slider_id' => $sliderId,
                'title_text' => 'New Martvill’s',
                'title_animation' => 'fadeIn',
                'title_delay' => NULL,
                'title_font_color' => '#2c2c2c',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'CLOTHES <span style="color:#19c880;margin-top:10px">YOU LOVE<span>',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => NULL,
                'sub_title_font_color' => '#2c2c2c',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => NULL,
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => NULL,
                'description_title_font_color' => '#2c2c2c',
                'description_title_font_size' => NULL,
                'description_title_direction' => 'left',
                'button_title' => 'Shop Now',
                'button_link' => $url . '/search-products?categories=&keyword=&brands=&attributes=&price_range=&rating=&sort_by=Price%20Low%20to%20High&showing=12',
                'button_font_color' => '#2c2c2c',
                'button_bg_color' => '#ffffff',
                'button_position' => 'left',
                'button_animation' => 'fadeIn',
                'button_delay' => NULL,
                'is_open_in_new_window' => 'Yes',
            ]);

            $fileId = File::insertGetId([
                'params' => '{"size":559.9208984375,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230508/210516239bbb59ecf89038a5e7ed12c2.png',
                'file_size' => 559.92,
                'original_file_name' => 'Banner (9).png',
            ]);
            ObjectFile::insert([
                'object_type' => 'slides',
                'object_id' => $slideId,
                'file_id' => $fileId,
            ]);

            $slideId = Slide::insertGetId([
                'slider_id' => $sliderId,
                'title_text' => 'New Martvill’s',
                'title_animation' => 'fadeIn',
                'title_delay' => NULL,
                'title_font_color' => '#2c2c2c',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'CLOTHES <span style="color:#19c880;margin-top:10px">YOU LOVE<span>',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => NULL,
                'sub_title_font_color' => '#2c2c2c',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => NULL,
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => NULL,
                'description_title_font_color' => '#2c2c2c',
                'description_title_font_size' => NULL,
                'description_title_direction' => 'left',
                'button_title' => 'Shop Now',
                'button_link' => url('/') . '/search-products?categories=&keyword=&brands=&attributes=&price_range=&rating=&sort_by=Price%20Low%20to%20High&showing=12',
                'button_font_color' => '#2c2c2c',
                'button_bg_color' => '#ffffff',
                'button_position' => 'left',
                'button_animation' => 'fadeIn',
                'button_delay' => NULL,
                'is_open_in_new_window' => 'Yes',
            ]);

            $fileId = File::insertGetId([
                'params' => '{"size":546.9921875,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230508/b386fcfb69e3536852adf5ff1e30a8ae.png',
                'file_size' => 546.99,
                'original_file_name' => 'Banner (13).png',
            ]);
            ObjectFile::insert([
                'object_type' => 'slides',
                'object_id' => $slideId,
                'file_id' => $fileId,
            ]);

            $slideId = Slide::insertGetId([
                'slider_id' => $sliderId,
                'title_text' => 'New Martvill’s',
                'title_animation' => 'fadeIn',
                'title_delay' => NULL,
                'title_font_color' => '#2c2c2c',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'CLOTHES <span style="color:#19c880;margin-top:10px">YOU LOVE<span>',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => NULL,
                'sub_title_font_color' => '#2c2c2c',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => NULL,
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => NULL,
                'description_title_font_color' => '#2c2c2c',
                'description_title_font_size' => NULL,
                'description_title_direction' => 'left',
                'button_title' => 'Shop Now',
                'button_link' => url('/') . '/search-products?categories=&keyword=&brands=&attributes=&price_range=&rating=&sort_by=Price%20Low%20to%20High&showing=12',
                'button_font_color' => '#2c2c2c',
                'button_bg_color' => '#ffffff',
                'button_position' => 'left',
                'button_animation' => 'fadeIn',
                'button_delay' => NULL,
                'is_open_in_new_window' => 'Yes',
            ]);

            $fileId = File::insertGetId([
                'params' => '{"size":611.509765625,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230508/23ea6b3e22487115ddddb3db16709972.png',
                'file_size' => 611.51,
                'original_file_name' => 'Banner (11).png',
            ]);

            ObjectFile::insert([
                'object_type' => 'slides',
                'object_id' => $slideId,
                'file_id' => $fileId,
            ]);
        }

        $dbSlider = Slider::where(['slug' => 'fashion-v51'])->first();

        if (!$dbSlider) {
            $sliderId = Slider::insertGetId([
                'name' => 'Fashion V5.1',
                'slug' => 'fashion-v51',
                'status' => 'Active',
            ]);

            $slideId = Slide::insertGetId([
                'slider_id' => $sliderId,
                'title_text' => 'New Martvill’s',
                'title_animation' => 'fadeIn',
                'title_delay' => NULL,
                'title_font_color' => '#2c2c2c',
                'title_font_size' => 26,
                'title_direction' => 'right',
                'sub_title_text' => 'LIVING & <span style="color:#19c880;margin-top:10px">FASHION<span>',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => NULL,
                'sub_title_font_color' => '#2c2c2c',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'right',
                'description_title_text' => NULL,
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => NULL,
                'description_title_font_color' => '#000000',
                'description_title_font_size' => NULL,
                'description_title_direction' => 'left',
                'button_title' => 'Explore Now',
                'button_link' => $url . '/search-products?categories=&keyword=&brands=&attributes=&price_range=&rating=&sort_by=Price%20Low%20to%20High&showing=12',
                'button_font_color' => '#2c2c2c',
                'button_bg_color' => '#ffffff',
                'button_position' => 'right',
                'button_animation' => 'fadeIn',
                'button_delay' => NULL,
                'is_open_in_new_window' => 'Yes',
            ]);

            $fileId = File::insertGetId([
                'params' => '{"size":442.9423828125,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230507/f9a0d2cb5ab84a2b432c0ecb8728bf9e.png',
                'file_size' => 442.94,
                'original_file_name' => 'Banner Inage.png',
            ]);

            ObjectFile::insert([
                'object_type' => 'slides',
                'object_id' => $slideId,
                'file_id' => $fileId,
            ]);
        }

        $dbSlider = Slider::where(['slug' => 'fashion-v53'])->first();

        if (!$dbSlider) {
            $sliderId = Slider::insertGetId([
                'name' => 'Fashion V5.3',
                'slug' => 'fashion-v53',
                'status' => 'Active',
            ]);

            $slideId = Slide::insertGetId([
                'slider_id' => $sliderId,
                'title_text' => 'Martvill Furnitures',
                'title_animation' => 'fadeIn',
                'title_delay' => NULL,
                'title_font_color' => '#2c2c2c',
                'title_font_size' => 26,
                'title_direction' => 'left',
                'sub_title_text' => 'LUXURIOUS <span style="color:#19c880;margin-top:10px">COMFORT<span>',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => NULL,
                'sub_title_font_color' => '#2c2c2c',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'left',
                'description_title_text' => NULL,
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => NULL,
                'description_title_font_color' => '#000000',
                'description_title_font_size' => NULL,
                'description_title_direction' => 'left',
                'button_title' => 'Explore Now',
                'button_link' => $url . '/search-products?categories=&keyword=&brands=&attributes=&price_range=&rating=&sort_by=Price%20Low%20to%20High&showing=12',
                'button_font_color' => '#2c2c2c',
                'button_bg_color' => '#ffffff',
                'button_position' => 'left',
                'button_animation' => 'fadeIn',
                'button_delay' => NULL,
                'is_open_in_new_window' => 'Yes',
            ]);

            $fileId = File::insertGetId([
                'params' => '{"size":442.763671875,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230507/d802d12383bdb75e161b7802edbaccc6.png',
                'file_size' => 442.76,
                'original_file_name' => 'Image banner (1).png',
            ]);

            ObjectFile::insert([
                'object_type' => 'slides',
                'object_id' => $slideId,
                'file_id' => $fileId,
            ]);
        }

        $dbSlider = Slider::where(['slug' => 'fashion-v54'])->first();

        if (!$dbSlider) {
            $sliderId = Slider::insertGetId([
                'name' => 'Fashion V5.4',
                'slug' => 'fashion-v54',
                'status' => 'Active',
            ]);

            $slideId = Slide::insertGetId([
                'slider_id' => $sliderId,
                'title_text' => 'New Martvill’s',
                'title_animation' => 'fadeIn',
                'title_delay' => NULL,
                'title_font_color' => '#2c2c2c',
                'title_font_size' => 26,
                'title_direction' => 'right',
                'sub_title_text' => 'LIVING & <span style="color:#19c880;margin-top:10px">FASHION<span>',
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => NULL,
                'sub_title_font_color' => '#2c2c2c',
                'sub_title_font_size' => 40,
                'sub_title_direction' => 'right',
                'description_title_text' => NULL,
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => NULL,
                'description_title_font_color' => '#000000',
                'description_title_font_size' => NULL,
                'description_title_direction' => 'left',
                'button_title' => 'Explore Now',
                'button_link' => $url . '/search-products?categories=&keyword=&brands=&attributes=&price_range=&rating=&sort_by=Price%20Low%20to%20High&showing=12',
                'button_font_color' => '#2c2c2c',
                'button_bg_color' => '#ffffff',
                'button_position' => 'right',
                'button_animation' => 'fadeIn',
                'button_delay' => NULL,
                'is_open_in_new_window' => 'Yes',
            ]);

            $fileId = File::insertGetId([
                'params' => '{"size":324.2421875,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230508/4954426c8a08e202052a44b5eba62232.png',
                'file_size' => 324.24,
                'original_file_name' => 'Banner Inage (1).png',
            ]);

            ObjectFile::insert([
                'object_type' => 'slides',
                'object_id' => $slideId,
                'file_id' => $fileId,
            ]);
        }

            

        $dbSlider = Slider::where(['slug' => 'fashion-v55'])->first();

        if (!$dbSlider) {
            $sliderId = Slider::insertGetId([
                'name' => 'Fashion V5.2',
                'slug' => 'fashion-v52',
                'status' => 'Active',
            ]);

            $slideId = Slide::insertGetId([
                'slider_id' => $sliderId,
                'title_text' => NULL,
                'title_animation' => 'fadeIn',
                'title_delay' => NULL,
                'title_font_color' => '#000000',
                'title_font_size' => NULL,
                'title_direction' => 'left',
                'sub_title_text' => NULL,
                'sub_title_animation' => 'fadeIn',
                'sub_title_delay' => NULL,
                'sub_title_font_color' => '#000000',
                'sub_title_font_size' => NULL,
                'sub_title_direction' => 'left',
                'description_title_text' => NULL,
                'description_title_animation' => 'fadeIn',
                'description_title_delay' => NULL,
                'description_title_font_color' => '#000000',
                'description_title_font_size' => NULL,
                'description_title_direction' => 'left',
                'button_title' => NULL,
                'button_link' => NULL,
                'button_font_color' => '#ffffff',
                'button_bg_color' => '#000000',
                'button_position' => 'left',
                'button_animation' => 'fadeIn',
                'button_delay' => NULL,
                'is_open_in_new_window' => 'Yes',
            ]);

            $fileId = File::insertGetId([
                'params' => '{"size":1531.1787109375,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20230507/707746a7e3dfc2a1d715e3eb9da81372.png',
                'file_size' => 1531.18,
                'original_file_name' => 'Sale Banner.png',
            ]);

            ObjectFile::insert([
                'object_type' => 'slides',
                'object_id' => $slideId,
                'file_id' => $fileId,
            ]);
        }
    }
}
