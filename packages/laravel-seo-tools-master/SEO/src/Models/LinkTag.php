<?php

namespace Rastventure\SEO\Models;

use Illuminate\Database\Eloquent\Model;
use Rastventure\SEO\Contracts\LinkTag as LinkTagContract;

/**
   @property varchar $rel rel
@property varchar $href href
@property varchar $status status
@property int $page_id page id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
   
 */
class LinkTag extends Model implements LinkTagContract
{

    /**
     * Database table name
     */
    protected $table = 'seo_link_tags';
    /**
     * Protected columns from mass assignment
     */
    protected $guarded = ['id'];


    /**
     * Date time columns.
     */
    protected $dates = [];
}
