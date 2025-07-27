<?php

namespace Modules\CMS\Database\Seeders\versions\v1_2_0;

use Illuminate\Database\Seeder;
use Modules\CMS\Entities\{
    Component, ComponentProperty, Page
};

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run() {
        $dbPage = Page::where(['slug' => 'home-10'])->first();

        if (!$dbPage) {
            $pageId = Page::insertGetId([
                'name' => 'Fashion V5',
                'slug' => 'home-10',
                'css' => NULL,
                'description' => NULL,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'status' => 'Active',
                'type' => 'home',
                'layout' => 'fashion_v5',
                'default' => 0,
            ]);

            $componentId = Component::insertGetId([
                'page_id' => $pageId,
                'layout_id' => 10,
                'level' => 2,
            ]);

            ComponentProperty::insert([
                [
                    'component_id' => $componentId,
                    'name' => 'slider',
                    'type' => 'string',
                    'value' => 'fashion-v51',
                ], [
                    'component_id' => $componentId,
                    'name' => 'full',
                    'type' => 'string',
                    'value' => '1',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mt',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mb',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'height',
                    'type' => 'string',
                    'value' => '749',
                ], [
                    'component_id' => $componentId,
                    'name' => 'rounded',
                    'type' => 'string',
                    'value' => '0',
                ]
            ]);

            $componentId = Component::insertGetId([
                'page_id' => $pageId,
                'layout_id' => 10,
                'level' => 3,
            ]);

            ComponentProperty::insert([
                [
                    'component_id' => $componentId,
                    'name' => 'slider',
                    'type' => 'string',
                    'value' => 'fashion-v52',
                ], [
                    'component_id' => $componentId,
                    'name' => 'full',
                    'type' => 'string',
                    'value' => '1',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mt',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mb',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'height',
                    'type' => 'string',
                    'value' => '903',
                ], [
                    'component_id' => $componentId,
                    'name' => 'rounded',
                    'type' => 'string',
                    'value' => '0',
                ]
            ]);

            $componentId = Component::insertGetId([
                'page_id' => $pageId,
                'layout_id' => 10,
                'level' => 4,
            ]);

            ComponentProperty::insert([
                [
                    'component_id' => $componentId,
                    'name' => 'slider',
                    'type' => 'string',
                    'value' => 'fashion-v53',
                ], [
                    'component_id' => $componentId,
                    'name' => 'full',
                    'type' => 'string',
                    'value' => '1',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mt',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mb',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'height',
                    'type' => 'string',
                    'value' => '631',
                ], [
                    'component_id' => $componentId,
                    'name' => 'rounded',
                    'type' => 'string',
                    'value' => '0',
                ]
            ]);

            $componentId = Component::insertGetId([
                'page_id' => $pageId,
                'layout_id' => 10,
                'level' => 1,
            ]);

            ComponentProperty::insert([
                [
                    'component_id' => $componentId,
                    'name' => 'slider',
                    'type' => 'string',
                    'value' => 'fashion-v5-primary',
                ], [
                    'component_id' => $componentId,
                    'name' => 'full',
                    'type' => 'string',
                    'value' => '1',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mt',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mb',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'height',
                    'type' => 'string',
                    'value' => '750',
                ], [
                    'component_id' => $componentId,
                    'name' => 'rounded',
                    'type' => 'string',
                    'value' => '0',
                ]
            ]);

            $componentId = Component::insertGetId([
                'page_id' => $pageId,
                'layout_id' => 10,
                'level' => 5,
            ]);

            ComponentProperty::insert([
                [
                    'component_id' => $componentId,
                    'name' => 'slider',
                    'type' => 'string',
                    'value' => 'fashion-v54',
                ], [
                    'component_id' => $componentId,
                    'name' => 'full',
                    'type' => 'string',
                    'value' => '1',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mt',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mb',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'height',
                    'type' => 'string',
                    'value' => '631',
                ], [
                    'component_id' => $componentId,
                    'name' => 'rounded',
                    'type' => 'string',
                    'value' => '0',
                ]
            ]);

            $componentId = Component::insertGetId([
                'page_id' => $pageId,
                'layout_id' => 10,
                'level' => 6,
            ]);

            ComponentProperty::insert([
                [
                    'component_id' => $componentId,
                    'name' => 'slider',
                    'type' => 'string',
                    'value' => 'fashion-v55',
                ], [
                    'component_id' => $componentId,
                    'name' => 'full',
                    'type' => 'string',
                    'value' => '1',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mt',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mb',
                    'type' => 'string',
                    'value' => '0px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'height',
                    'type' => 'string',
                    'value' => '631',
                ], [
                    'component_id' => $componentId,
                    'name' => 'rounded',
                    'type' => 'string',
                    'value' => '0',
                ]
            ]);

            $componentId = Component::insertGetId([
                'page_id' => $pageId,
                'layout_id' => 8,
                'level' => 8,
            ]);
            
            ComponentProperty::insert([
                [
                    'component_id' => $componentId,
                    'name' => 'iconbox',
                    'type' => 'array',
                    'value' => '[{"image":"20230508\\\\72911ed50cb98c54b7dd269a763d788d.png","title":"Free Shipping Worldwide","subtitle":"For all orders over $350"},{"image":"20230508\\\\9b51a4ca185894d42c25cc22db2e2b78.png","title":"Secured Online Payment","subtitle":"Payment protection guaranteed"},{"image":"20230508\\\\e28c3efa16347662b4f3f3877dc49741.png","title":"Money Back Guarantee","subtitle":"If goods have problems"}]',
                ], [
                    'component_id' => $componentId,
                    'name' => 'sidebox_show',
                    'type' => 'string',
                    'value' => '0',
                ], [
                    'component_id' => $componentId,
                    'name' => 'sidebox',
                    'type' => 'array',
                    'value' => '{"title":"","sidetext":"","description":""}',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mt',
                    'type' => 'string',
                    'value' => '70px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'mb',
                    'type' => 'string',
                    'value' => '70px',
                ], [
                    'component_id' => $componentId,
                    'name' => 'rounded',
                    'type' => 'string',
                    'value' => '1',
                ]
            ]);
        }

    }
}
