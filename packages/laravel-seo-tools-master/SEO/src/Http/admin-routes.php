<?php
Route::group([
    'prefix'        => 'admin/seo',
    'middleware'    => ['web', 'admin'],
], function () {

    /* ################ ANALYSIS ROUTE ################## */
    Route::get('analysis', 'Rastventure\SEO\Http\Controllers\Admin\AnalysisController@index')->defaults('_config', [
        'view' => 'seo::admin.pages.analysis.index',
    ])->name('admin.seo.analysis.index');
    /* ################ ANALYSIS ROUTE ENDS ################## */


    /* ################ DASHBOARD ROUTE ################## */
    Route::get('dashboard', 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@index')->defaults('_config', [
        'view' => 'seo::admin.pages.dashboard.index',
    ])->name('admin.seo.dashboard.index');

    Route::get('dashboard/social', 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@social')->defaults('_config', [
        'view' => 'seo::admin.pages.dashboard.social',
    ])->name('admin.seo.dashboard.social');

    Route::get('dashboard/sitemap', 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@sitemap')->defaults('_config', [
        'view' => 'seo::admin.pages.dashboard.sitemap',
    ])->name('admin.seo.dashboard.sitemap');

    Route::get('dashboard/tools', 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@tools')->defaults('_config', [
        'view' => 'seo::admin.pages.dashboard.tools',
    ])->name('admin.seo.dashboard.tools');

    Route::get('dashboard/advanced', 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@advanced')->defaults('_config', [
        'view' => 'seo::admin.pages.dashboard.advanced',
    ])->name('admin.seo.dashboard.advanced');
    /* ################ DASHBOARD ROUTE ENDS ################## */

    /* ################ SETTINGS ROUTE ################## */
    Route::get('settings', 'Rastventure\SEO\Http\Controllers\Admin\SettingController@index')->defaults('_config', [
        'view' => 'seo::admin.pages.settings.index',
    ])->name('admin.seo.settings.index');

    Route::post('settings/store', 'Rastventure\SEO\Http\Controllers\Admin\SettingController@store')->defaults('_config', [
        'redirect' => 'seo::admin.pages.settings.index',
    ])->name('admin.seo.settings.store');
    /* ################ SETTINGS ROUTE ENDS ################## */

    /* ################ PAGES ROUTE ################## */
    Route::get('pages', 'Rastventure\SEO\Http\Controllers\Admin\PageController@index')->defaults('_config', [
        'view' => 'seo::admin.pages.pages.index',
    ])->name('admin.seo.pages.index');

    Route::get('pages/create', 'Rastventure\SEO\Http\Controllers\Admin\PageController@create')->defaults('_config', [
        'view' => 'seo::admin.pages.pages.create',
    ])->name('admin.seo.pages.create');

    Route::post('pages/store', 'Rastventure\SEO\Http\Controllers\Admin\PageController@store')->defaults('_config', [
        'redirect' => 'seo::admin.pages.pages.index',
    ])->name('admin.seo.pages.store');
    /* ################ PAGES ROUTE ################## */

    /* ################ META TAGS ROUTE ################## */
    Route::get('meta-tags', 'Rastventure\SEO\Http\Controllers\Admin\PageController@index')->defaults('_config', [
        'view' => 'seo::admin.pages.meta-tags.index',
    ])->name('admin.seo.meta-tags.index');

    Route::get('meta-tags/create', 'Rastventure\SEO\Http\Controllers\Admin\PageController@create')->defaults('_config', [
        'view' => 'seo::admin.pages.meta-tags.create',
    ])->name('admin.seo.meta-tags.create');

    Route::post('meta-tags/global', 'Rastventure\SEO\Http\Controllers\Admin\MetaTagController@global')->defaults('_config', [
        'view' => 'seo::admin.pages.dashboard.index',
    ])->name('admin.seo.meta-tags.global');
    /* ################ META TAGS ROUTE ENDS ################## */






    Route::get('dashboard', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@index', 'as' => 'dashboard.index']);
    Route::get('dashboard/social', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@social', 'as' => 'dashboard.social']);
    Route::get('dashboard/sitemap', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@sitemap', 'as' => 'dashboard.sitemap']);
    Route::get('dashboard/tools', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@tools', 'as' => 'dashboard.tools']);
    Route::get('dashboard/advanced', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\DashboardController@advanced', 'as' => 'dashboard.advanced']);

    Route::resource('pages.images', 'Rastventure\SEO\Http\Controllers\Admin\ImageController', ['except' => ['show'], 'parameters' => [
        'images' => 'pageImage'
    ]]);

    Route::get('pages/bulk-edit', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@bulkEdit', 'as' => 'pages.bulkEdit']);
    Route::post('pages/bulk-update', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@bulkUpdate', 'as' => 'pages.bulkUpdate']);

    Route::post('pages/cache', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@cache', 'as' => 'pages.cache']);

    Route::post('pages/upload', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@upload', 'as' => 'pages.upload']);

    Route::get('pages/download-zip', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@zip', 'as' => 'pages.zip']);

    Route::get('pages/download', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@download', 'as' => 'pages.download']);

    Route::get('pages/meta/{page}', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@meta', 'as' => 'pages.meta']);

    Route::post('pages/meta/{page}', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@saveMeta', 'as' => 'pages.meta.save']);

    Route::get('pages/generate', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\PageController@generate', 'as' => 'pages.generate']);

    Route::resource('pages', 'Rastventure\SEO\Http\Controllers\Admin\PageController');

    Route::post('meta-tags/global', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\MetaTagController@global', 'as' => 'meta-tags.global']);

    Route::resource('meta-tags', 'Rastventure\SEO\Http\Controllers\Admin\MetaTagController');

    Route::post('settings/robot-txt', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\SettingController@robotTxt', 'as' => 'settings.robot_txt']);
    Route::post('settings/htaccess', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\SettingController@htaccess', 'as' => 'settings.htaccess']);

    Route::resource('settings', 'Rastventure\SEO\Http\Controllers\Admin\SettingController', ['only' => ['index', 'store']]);

    Route::post('sitemap/update', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\SiteMapController@update', 'as' => 'sitemap.update']);
    Route::post('sitemap/generate', ['uses' => 'Rastventure\SEO\Http\Controllers\Admin\SiteMapController@store', 'as' => 'sitemap.generate']);
});
