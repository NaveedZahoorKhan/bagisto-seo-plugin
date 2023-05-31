<?php

namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;
use Rastventure\SEO\Contracts\MetaTag;
class MetaTagRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return MetaTag::class;
    }

    /**
     * Create Meta Tag.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function create($attributes)
    {

        $meta_tag = parent::create($attributes);
        return $meta_tag;
    }

    /**
     * Update Meta Tag.
     * @param  array  $attributes
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return parent::update($attributes, $id);
    }
}
