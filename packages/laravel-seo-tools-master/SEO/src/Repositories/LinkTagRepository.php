<?php

namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;
use Rastventure\SEO\Contracts\LinkTag;
class LinkTagRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return LinkTag::class;
    }

    /**
     * Create Link Tag.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function create($attributes)
    {

        $link_tag = parent::create($attributes);
        return $link_tag;
    }

    /**
     * Update Link Tag.
     *
     * @param  array  $attributes
     * @return mixed
     */
    public function update(array $attributes, $id)
    {

        return parent::update($attributes, $id);
    }
}
