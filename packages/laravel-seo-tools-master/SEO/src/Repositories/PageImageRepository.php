<?php

namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;

class PageImageRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Rastventure\SEO\Contracts\PageImage::class;
    }

    /**
     * Create Page Image.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function create($attributes)
    {
       return parent::create($attributes);
    }

    /**
     * Update Page Image.
     * @param  array  $attributes
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return parent::update($attributes, $id);
    }
}
