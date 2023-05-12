<?php 
namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;

class PageMetaTagRepository extends Repository {
    
        /**
        * Specify Model class name
        *
        * @return mixed
        */
        function model()
        {
            return Rastventure\SEO\Contracts\PageMetaTag::class;
        }
}