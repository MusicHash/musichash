<?php namespace App\Libraries;

use Exception;
use App\Exceptions\FBRequestException;
use App\Exceptions\FBAuthenticationTokenException;
use App\Exceptions\FBAuthenticationTokenInvalidException;
use App\Exceptions\FBAuthenticationTokenExtendException;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

/**
 * FBAuthentication class, responsible for getting user info and oAuth wrapping and token managment
 */
class FBAuthentication
{
    /**
     * LaravelFacebookSdk object instance
     */
    private $fb;
    
    
    /**
     * FBAuthentication constructor method
     *
     * @param LaravelFacebookSdk $fb
     */
    public function __construct($fb)
    {
        $this->fb = $fb;
    }
    
    
    /**
     * Extracts data from FB's redirect - usually after user completes the oAuth permission step.
     *
     * @throws
     * @param string $returnUrl
     * @return string - Facebook access token
     */
    public function getAccessTokenFromRedirect($returnUrl = '')
    {
        try
        {
            // fetch token
            $accessToken = $this->fb->getAccessTokenFromRedirect($returnUrl);
        } catch (Exception $e)
        {
            throw new FBAuthenticationTokenException;
        }
        
        // no token found
        if (!$accessToken)
        {
            throw new FBAuthenticationTokenInvalidException;
        }
        
        return $accessToken;
    }
    
    
    /**
     * Extends short lived token to a long lived access token. By facebook policy up-tp 90 days.
     * Verifies the state of the token and only if needed will query the oAuth client for a longer token.
     *
     * @throws
     * @param Facebook\Authentication\AccessToken $accessToken
     * @return Facebook\Authentication\AccessToken
     */
    public function extendAccessToken($accessToken)
    {
        if (!$accessToken->isLongLived())
        {
            $oAuth = $this->fb->getOAuth2Client();
            
            try
            {
                $accessToken = $oAuth->getLongLivedAccessToken($accessToken);
            } catch (Exception $e) {
                throw new FBAuthenticationTokenExtendException;
            }
        }
        
        return $accessToken;
    }
    
    
    /**
     * Get user info of the currently logged in user. Query for his personal info.
     * Used mainly for creating the user or verifying the token availability.
     *
     * @throws
     * @param array $fields
     * @return Facebook\GraphNodes\GraphNode user object
     */
    public function getUser($fields = ['id', 'name', 'email', 'gender', 'age_range'])
    {
        try
        {
            $query = $this->fb->get('/me?fields='. implode(',', $fields));
            $graphUser = $query->getGraphObject();
        } catch (Exception $e) {
            throw new FBRequestException;
        }
        
        return $graphUser;
    }
}