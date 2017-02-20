<?php
/*
 * This file is part of the TrustPilot library.
 *
 * (c) Guillaume Bourdages <gbourdages@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TrustPilot\Api;

/**
 * @author Guillaume Bourdages <gbourdages@graphem.ca>
 */

use TrustPilot\TrustPilot;

class Consumer extends AbstractApi{
  
    /**
     * Get the web links of the consumer
     * https://developers.trustpilot.com/consumer-api#get-the-web-links-of-the-consumer
     * @param  string, string
     * @return array
     */
    public function getWebLinks($consumerId, $locale = 'en-US')
    {
        return json_decode(
            $this->api->get('consumers/' . $consumerId . '/web-links',
                ['query' => 
                    [
                       'locale' => $locale, 
                    ]
                ]
            ));
    }

    /**
     * Get the web links of the consumer
     * https://developers.trustpilot.com/consumer-api#get-a-list-of-consumer-profiles
     * @param  string, string
     * @return array
     */
    public function fetchProfiles($data)
    {
        return json_decode(
            $this->api->post('consumers/profile/bulk',
                array('json' => $data)
            ));
    }

    /**
     * GeGet the profile of the consumer(with #reviews and weblinks)
     * https://developers.trustpilot.com/consumer-api#get-the-profile-of-the-consumer(with-#reviews-and-weblinks)
     * @param  string
     * @return array
     */
    public function getProfileWithReviewsAndLinks($consumerId)
    {
        return json_decode(
            $this->api->get('consumers/' . $consumerId));
    }

    /**
     * Get the profile of the consumer
     * https://developers.trustpilot.com/consumer-api#get-the-profile-of-the-consumer
     * @param  string
     * @return array
     */
    public function getProfile($consumerId)
    {
        return json_decode(
            $this->api->get('consumers/' . $consumerId . '/profile'));
    }

    /**
     * Get a consumer's reviews
     * https://developers.trustpilot.com/consumer-api#get-a-consumer's-reviews
     * @param  string, string
     * @return array
     */
    public function getReviews($consumerId, $data = array())
    {
        return json_decode(
            $this->api->get('consumers/' . $consumerId . '/reviews',
                ['query' => 
                    [
                       'stars' => $data['stars'],
                       'language' => $data['language'], 
                       'page' => $data['page'], 
                       'perPage' => $data['perPage'], 
                       'orderBy' => $data['orderBy'], 
                       'includeReportedReviews' => $data['includeReportedReviews']
                    ]
                ]
            ));
    }

}