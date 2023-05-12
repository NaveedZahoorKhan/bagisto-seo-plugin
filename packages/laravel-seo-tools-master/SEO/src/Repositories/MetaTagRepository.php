<?php 
namespace Rastventure\SEO\Repositories;

use Webkul\Core\Eloquent\Repository;

class MetaTagRepository extends Repository {
    
        /**
        * Specify Model class name
        *
        * @return mixed
        */
        function model()
        {
            return Rastventure\SEO\Contracts\MetaTag::class;
        }
}