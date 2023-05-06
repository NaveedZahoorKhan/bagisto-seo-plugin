<?php

namespace Rastventure\SEO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seo_meta_tags')->insert([
            [
                'name' => 'author',
                'property' => '',
                'status' => 'active',
                'group' => '',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Author of this article/webpage',
                'input_info' => 'Author of this article/webpage',
            ],
            [
                'name' => 'generator',
                'property' => '',
                'status' => 'active',
                'group' => '',
                'visibility' => 'global',
                'default_value' => 'Laravel 5.5',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. Laravel 5.4',
                'input_label' => 'Website building Program',
                'input_info' => 'Name of the program you used to build this website',
            ],
            [
                'name' => '',
                'property' => 'og:locale',
                'status' => 'active',
                'group' => 'og',
                'visibility' => 'global',
                'default_value' => 'en_US',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. en_US',
                'input_label' => 'Website Language',
                'input_info' => '',
            ],
            [
                'name' => '',
                'property' => 'og:type',
                'status' => 'active',
                'group' => 'og',
                'visibility' => 'page',
                'default_value' => 'article|webpage',
                'input_type' => 'text',
                'input_placeholder' => 'either article or webpage',
                'input_label' => 'Page Type',
                'input_info' => '',
            ],
            [
                'name' => '',
                'property' => 'og:title',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => 'Page title',
                'input_label' => 'Page Title',
                'input_info' => 'If blank default page title will be used',
            ],
            [
                'name' => '',
                'property' => 'og:description',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Meta description',
                'input_info' => 'When share to social media this will be shown along with image.',
            ],
            [
                'name' => '',
                'property' => 'og:url',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. www.example.com/page.php',
                'input_label' => 'Page Url',
                'input_info' => 'If blank page url will be used',
            ],
            [
                'name' => '',
                'property' => 'og:site_name',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'global',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. MyCms',
                'input_label' => 'Site Name',
                'input_info' => 'Your site name',
            ],
            [
                'name' => '',
                'property' => 'og:image',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'file',
                'input_placeholder' => '',
                'input_label' => 'Image',
                'input_info' => 'This image will be used on social media',
            ],
            [
                'name' => '',
                'property' => 'og:image:alt',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Image Alt Property',
                'input_info' => ' If the page specifies an og:image it should specify og:image:alt',
            ],
            [
                'name' => '',
                'property' => 'og:image:width',
                'status' => 'inactive',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Image Width',
                'input_info' => 'This image width. Recommended by Facebook',
            ],
            [
                'name' => '',
                'property' => 'og:image:height',
                'status' => 'inactive',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Image Height',
                'input_info' => 'This image height. Recommended by Facebook',
            ],
            [
                'name' => '',
                'property' => 'og:video',
                'status' => 'inactive',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'url',
                'input_placeholder' => '',
                'input_label' => 'Video URL',
                'input_info' => 'Video URL.If page have any',
            ],
            [
                'name' => '',
                'property' => 'og:audio',
                'status' => 'inactive',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'url',
                'input_placeholder' => '',
                'input_label' => 'Audio URL',
                'input_info' => 'Audio URL. If page have any',
            ],

            [
                'name' => '',
                'property' => 'fb:admins',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'global',
                'input_type' => 'number',
                'input_placeholder' => 'Facebook numeric ID',
                'input_label' => 'Facebook Admin Id',
                'input_info' => 'Visit: https://developers.facebook.com/tools/debug/accesstoken to get your id',
            ],
            [
                'name' => '',
                'property' => 'fb:app_id',
                'status' => 'active',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'global',
                'input_type' => 'number',
                'input_placeholder' => 'Facebook numeric ID',
                'input_label' => 'Facebook App ID',
                'input_info' => 'Visit: https://developers.facebook.com/tools/debug/accesstoken to get your id',
            ],
            [
                'name' => '',
                'property' => 'article:publisher',
                'status' => 'inactive',
                'group' => 'article',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Author of this page/post',
                'input_info' => '',
            ],
            [
                'name' => '',
                'property' => 'article:tag',
                'status' => 'inactive',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. Html, Css',
                'input_label' => ' Article Tags',
                'input_info' => ' Tag words associated with this article',
            ],
            [
                'name' => '',
                'property' => 'article:section',
                'status' => 'inactive',
                'group' => 'article',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Category of this article',
                'input_info' => '',
            ],
            [
                'name' => '',
                'property' => 'article:published_time',
                'status' => 'inactive',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. 2013-09-16T19:08:47+01:00',
                'input_label' => 'Article Publication time',
                'input_info' => 'Format:  2013-09-16T19:08:47+01:00',
            ],
            [
                'name' => '',
                'property' => 'article:modified_time',
                'status' => 'inactive',
                'group' => 'og',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. 2013-09-16T19:08:47+01:00',
                'input_label' => 'Article Modification time',
                'input_info' => 'Format: 2013-09-16T19:08:47+01:00',
            ],
            [
                'name' => 'twitter:card',
                'property' => '',
                'status' => 'active',
                'group' => 'twitter',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. summary_large_image',
                'default_value' => 'summary|summary_large_image|app|player',
                'input_label' => 'Twitter Card',
                'input_info' => '',
            ],
            [
                'name' => 'twitter:creator',
                'property' => '',
                'status' => 'active',
                'group' => 'twitter',
                'default_value' => '',
                'visibility' => 'global',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. @tuhinbepari12',
                'input_label' => 'Twitter account holder',
                'input_info' => '@username for the content creator / author.',
            ],
            [
                'name' => 'twitter:site',
                'property' => '',
                'status' => 'active',
                'group' => 'twitter',
                'default_value' => '',
                'visibility' => 'global',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. @tuhinbepari12',
                'input_label' => 'Twitter username',
                'input_info' => '@username for the website used in the card footer.',
            ],
            [
                'name' => 'twitter:description',
                'property' => '',
                'status' => 'active',
                'group' => 'twitter',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Twitter description',
                'input_info' => 'If blank page description will be used',
            ],
            [
                'name' => 'twitter:title',
                'property' => '',
                'status' => 'active',
                'group' => 'twitter',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'text',
                'input_placeholder' => '',
                'input_label' => 'Twitter title',
                'input_info' => 'If blank page title will be used',
            ],
            [
                'name' => 'twitter:image',
                'property' => '',
                'status' => 'active',
                'group' => 'twitter',
                'default_value' => '',
                'visibility' => 'page',
                'input_type' => 'file',
                'input_placeholder' => '',
                'input_label' => 'Twitter Image',
                'input_info' => 'This image will be shown when shared to twitter',
            ],
            [
                'name' => 'google-site-verification',
                'property' => '',
                'status' => 'active',
                'group' => 'webmaster_tools',
                'default_value' => '',
                'visibility' => 'global',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. 46CfjAikO4_0A9rp1...',
                'input_label' => 'Google Site Verification Token',
                'input_info' => 'Google Webmaster Tools',
            ],
            [
                'name' => 'msvalidate.01',
                'property' => '',
                'status' => 'active',
                'group' => 'webmaster_tools',
                'default_value' => '',
                'visibility' => 'global',
                'input_type' => 'text',
                'input_placeholder' => 'e.g. F69E1D33598A85...',
                'input_label' => 'Bing Site Verification Token',
                'input_info' => 'Bing Webmaster Tools',
            ]
        ]);
    }
}
