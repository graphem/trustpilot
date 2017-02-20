<?php

/*
 * This file is part of the TrustPilot library.
 *
 * (c) Guillaume Bourdages <gbourdages@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TrustPilot;

/**
 * @author Guillaume Bourdages <gbourdages@graphem.ca>
 */

use TrustPilot\Adapter\GuzzleHttpAdapter;
use TrustPilot\Api\Authorize;
use TrustPilot\Api\Categories;
use TrustPilot\Api\Consumer;
use TrustPilot\Api\Invitation;
use TrustPilot\Api\Resources;
use TrustPilot\Api\BusinessUnit;
use TrustPilot\Api\ProductReviews;
use TrustPilot\Api\ServicesReviews;

class TrustPilot
{
    
    /**
     * @var string
     */
    const ENDPOINT = 'https://api.trustpilot.com/v1/';

    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var String
     */
    protected $secret;

    /**
     * @var String
     */
    protected $apiKey;

    /**
     * @var String
     */
    protected $adapter;

    /**
     * @var String
     */
    protected $token;


    /**
     * @param AdapterInterface $adapter
     */
    public function __construct($apiKey, $secret, $endpoint = null)
    {          
        $this->apiKey = $apiKey;
        $this->secret = $secret;
        $this->endpoint = $endpoint ?: static::ENDPOINT;
    }

    /**
     * Set the access token
     *
     * @param  
     * @return 
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * get the access token
     *
     * @param  
     * @return 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Initiate the client for API transation
     *
     * @param  
     * @return 
     */
    protected function setAdapter(AdapterInterface $adapter = null, $headers = [])
    {
        if(is_null($adapter)){
            $this->client = new GuzzleHttpAdapter($headers,$this->endpoint);
            return $this;
        }
        $this->client = new $adapter($headers,$this->endpoint);
        return $this;        
    }

    /**
     * Set adapter to use token from Oauth
     *
     * @param  
     * @return 
     */
    protected function setAdapterWithToken()
    {
        $headers = ['headers' => 
                        ['Authorization' => 'Bearer '. $this->token->access_token]                    
                   ];
        $this->setAdapter($this->adapter,$headers);
    }

    /**
     * Set adapter to use API key
     *
     * @param  
     * @return 
     */
    protected function setAdapterWithApikey()
    {
        $headers = ['headers' => 
                        ['apikey' => $this->apiKey]                    
                   ];
        $this->setAdapter($this->adapter,$headers);
    }

    /**
     * Get the client
     *
     * @param  
     * @return 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return Authorize Api
     */
    public function authorize()
    {
        $headers = ['headers' => 
                        ['Authorization' => base64_encode($this->apiKey . ':' . $this->secret) ]                    
                   ];
        $this->setAdapter($this->adapter,$headers);
        return new Authorize($this);
    }

    /**
     * @return Business Unit
     */
    public function businessUnit()
    {
        $this->setAdapterWithApikey();
        return new BusinessUnit($this);
    }

    /**
     * @return Categories API
     */
    public function categories()
    {
        $this->setAdapterWithApikey();
        return new Categories($this);
    }

    /**
     * @return Consumer API
     */
    public function consumer()
    {
        $this->setAdapterWithApikey();
        return new Consumer($this);
    }

    /**
     * @return Resources API
     */
    public function resources()
    {
        $this->setAdapterWithApikey();
        return new Consumer($this);
    }

    /**
     * @return Invitation API
     */
    public function invitation()
    {
        $this->endpoint = 'https://invitations-api.trustpilot.com/v1/';
        $this->setAdapterWithToken();
        return new Invitation($this);
    }

    /**
     * @return Product Reviews API
     */
    public function productReviews()
    {
        $this->setAdapterWithToken();
        return new ProductReviews($this);
    }

    /**
     * @return Service Reviews API
     */
    public function serviceReviews()
    {
        $this->setAdapterWithToken();
        return new ServiceReviews($this);
    }

}