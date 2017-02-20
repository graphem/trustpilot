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

abstract class AbstractApi
{
    
    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $return;

    /**
     * @var string
     */
    protected $api;

    /**
     * @var string
     */
    protected $client;

    /**
     * Request data when doing create or update method
     *
     * @var string
     */
    

    public function __construct(TrustPilot $client)
    {
        $this->client = $client;
        $this->api = $client->getClient();
    }

}