<?php
/*
 * This file is part of the TrustPilot library.
 *
 * (c) Guillaume Bourdages <info@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TrustPilot\Api;

/**
 * @author Guillaume Bourdages <info@graphem.ca>
 */

use TrustPilot\TrustPilot;

class Categories extends AbstractApi{
  
    /**
     * Get a list of categories under a specific parent category.
     *
     * @param  
     * @return 
     */
    public function listCategories($country, $parentId = '', $local = 'en-US')
    {
        return json_decode(
            $this->api->get('categories',
                ['query' => 
                    [
                       'country' => $country, 
                       'parentId' => $parentId, 
                       'local' => $local
                    ]
                ]
            ));
    }

    /**
     * Get details of a specific category by its name.
     *
     * @param  
     * @return 
     */
    public function getCategory($categoryId, $country, $local = 'en-US')
    {
        return json_decode(
            $this->api->get('categories/'.$categoryId,
                ['query' => 
                    [
                       'country' => $country, 
                       'local' => $local
                    ]
                ]
            ));
    }

    /**
     * Find category
     *
     * @param  
     * @return 
     */
    public function findCategory($name, $country, $local = 'en-US')
    {
        return json_decode(
            $this->api->get('categories/find',
                ['query' => 
                    [
                       'name' => $name, 
                       'country' => $country, 
                       'local' => $local
                    ]
                ]
            ));
    }

    /**
     * Get a ranked list of business units in a specific category.
     *
     * @param  
     * @return 
     */
    public function listBusinessUnitsInCategory($categoryId, $country, $page = 1, $perPage = 20)
    {
        return json_decode(
            $this->api->get('categories/'.$categoryId.'/business-units',
                ['query' => 
                    [
                       'categoryId' => $categoryId, 
                       'country' => $country,
                       'page' => $page, 
                       'perPage' => $perPage, 
                    ]
                ]
            ));
    }

    /**
     * Get details of a specific category by its name.
     *
     * @param  
     * @return 
     */
    public function searchCategory($query, $country, $local = 'en-US')
    {
        return json_decode(
            $this->api->get('categories/search',
                ['query' => 
                    [
                       'categoryId' => $categoryId, 
                       'country' => $country,
                       'page' => $page, 
                       'perPage' => $perPage, 
                    ]
                ]
            ));
    }
}