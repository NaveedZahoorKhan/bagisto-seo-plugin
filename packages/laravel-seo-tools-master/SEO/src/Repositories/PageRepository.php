<?php

namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;

class PageRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Rastventure\SEO\Contracts\Page::class;
    }
    /**
     * Create Page.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function create($attributes)
    {

        $page = parent::create($attributes);
        return $page;
    }
    /**
     * Update Page.
     * @param  array  $attributes
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return parent::update($attributes, $id);
    }
}
