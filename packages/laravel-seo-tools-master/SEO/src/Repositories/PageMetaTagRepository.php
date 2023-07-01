<?php

namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;
use Rastventure\SEO\Contracts\PageMetaTag;
class PageMetaTagRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return PageMetaTag::class;
    }
    /**
     * Create Page Meta Tag.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function create($attributes)
    {

        $page_meta_tag = parent::create($attributes);
        return $page_meta_tag;
    }
    /**
     * Update Page Meta Tag.
     * @param  array  $attributes
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return parent::update($attributes, $id);
    }

    public function firstOrCreate(array $attributes = [])
    {
        return parent::firstOrCreate($attributes);
    }
}
