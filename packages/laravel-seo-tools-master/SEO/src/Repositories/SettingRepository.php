<?php

namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;

class SettingRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Rastventure\SEO\Contracts\Setting::class;
    }
    /**
     * Create Setting.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        $setting = parent::create($attributes);
        return $setting;
    }
    /**
     * Update Setting.
     * @param  array  $attributes
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return parent::update($attributes, $id);
    }
}
