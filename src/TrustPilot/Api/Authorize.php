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
use Carbon\Carbon;

class Authorize extends AbstractApi{

    
    /**
     * @var String
     */
    protected $token;

    /**
     * Set the token
     *
     * @param  string
     * @return string
     */
    public function setToken($token = '')
    {
        $this->token = $token;
    }

    /**
     * Get the toker
     *
     * @param  
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get Authorization Token
     *
     * @param  
     * @return 
     */
    public function createToken($type, $username = '', $password = '')
    {
        $response = json_decode($this->api->post(
            'oauth/oauth-business-users-for-applications/accesstoken',
            array(
                'form_params' => array(
                    'grant_type' => $type,
                    'username' => $username,
                    'password' => $password
                )
            )
        ));

       $this->token = $response;
    }

    /**
     * Refresh the token
     *
     * @param 
     * @return 
     */
    public function refreshToken()
    {
        $response = json_decode($this->api->post(
            'oauth/oauth-business-users-for-applications/refresh',
            array(
                'form_params' => array(
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->token->refresh_token
                )
            )
        ));

       $this->token = $response;
    }

    /**
     * Validate Token
     *
     * @param  
     * @return 
     */
    public function validateToken()
    {
        if(!$this->isValidToken()){
            $this->refreshToken();
        }
    }

    /**
     * Check if the token is valid
     *
     * @param  
     * @return 
     */
    public function isValidToken()
    {
        if(!isset($this->token)){
            return false;
        }

        $issued_at = intval(substr($this->token->issued_at, 0, -3));
        $expires_in = intval($this->token->expires_in);
        $expiry = $issued_at + $expires_in;

        $now = Carbon::now()->timestamp;

        if($now > ($expiry - 3600)){
            return false;
        }

        return true;

    }

}