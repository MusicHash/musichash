<?php

use App\Libraries\FBAuthentication;

class FBAuthenticationTest extends TestCase
{
    public function testIfTokenIsReturned()
    {
        $expected = '1111';
        
        $fb = Mockery::mock('LaravelFacebookSdk');
        $fb->shouldReceive('getAccessTokenFromRedirect')
           ->once()
           ->andReturn($expected);
           
        $fbAuth = new FBAuthentication($fb);
        $output = $fbAuth->getAccessTokenFromRedirect();
        
        $this->assertSame($expected, $output);
    }
    
    
    /**
     * @expectedException App\Exceptions\FBAuthenticationTokenInvalidException
     */
    public function testIfExceptionIsThrownWhenTokenIsEmpty()
    {
        $fb = Mockery::mock('LaravelFacebookSdk');
        $fb->shouldReceive('getAccessTokenFromRedirect')
           ->once()
           ->andReturn(false);
        
        $fbAuth = new FBAuthentication($fb);
        $output = $fbAuth->getAccessTokenFromRedirect();
    }
    
    
    /**
     * @expectedException App\Exceptions\FBAuthenticationTokenException
     */
    public function testIfProperExceptionIsThrownWhenFailedToGetToken()
    {
        $fb = Mockery::mock('LaravelFacebookSdk');
        $fb->shouldReceive('getAccessTokenFromRedirect')
           ->once()
           ->andThrow(new Facebook\Exceptions\FacebookSDKException);
        
        $fbAuth = new FBAuthentication($fb);
        $output = $fbAuth->getAccessTokenFromRedirect();
    }
    
    
    public function testIfExtendingShortLivedToken()
    {
        $expected = '1111';
        
        $fb = Mockery::mock('LaravelFacebookSdk');
        $fb->shouldReceive('getOAuth2Client')
           ->once()
           ->andReturnUsing(function() use ($expected) {
                $fbOAuth2Client = Mockery::mock('OAuth2Client');
                $fbOAuth2Client->shouldReceive('getLongLivedAccessToken')
                    ->once()
                    ->andReturn($expected);
                
                return $fbOAuth2Client;
            });
        
        $accessToken = Mockery::mock('Token');
        $accessToken->shouldReceive('isLongLived')
           ->once()
           ->andReturn(false);
        
        $fbAuth = new FBAuthentication($fb);
        $output = $fbAuth->extendAccessToken($accessToken);
        
        $this->assertSame($expected, $output);
    }
    
    
    public function testIfExtendingLongLivedToken()
    {
        $accessToken = Mockery::mock('Token');
        $accessToken->shouldReceive('isLongLived')
           ->once()
           ->andReturn(true);
        
        $fbAuth = new FBAuthentication(null);
        $output = $fbAuth->extendAccessToken($accessToken);
        
        $this->assertSame($accessToken, $output);
    }
    
    
    /**
     * @expectedException App\Exceptions\FBAuthenticationTokenExtendException
     */
    public function testIfExtendingShortLivedTokenExceptionIsThrown()
    {
        $fb = Mockery::mock('LaravelFacebookSdk');
        $fb->shouldReceive('getOAuth2Client')
           ->once()
           ->andReturnUsing(function() {
                $fbOAuth2Client = Mockery::mock('OAuth2Client');
                $fbOAuth2Client->shouldReceive('getLongLivedAccessToken')
                    ->once()
                    ->andThrow(new Facebook\Exceptions\FacebookSDKException);
                
                return $fbOAuth2Client;
            });
        
        $accessToken = Mockery::mock('Token');
        $accessToken->shouldReceive('isLongLived')
           ->once()
           ->andReturn(false);
        
        $fbAuth = new FBAuthentication($fb);
        $fbAuth->extendAccessToken($accessToken);
    }
    
    
    public function testIfFBUserIsReturned()
    {
        $expected = 'Graph response';
        
        $response = Mockery::mock('FacebookResponse');
        $response->shouldReceive('getGraphObject')
           ->once()
           ->andReturn($expected);
        
        $fb = Mockery::mock('LaravelFacebookSdk');
        $fb->shouldReceive('get')
           ->once()
           ->andReturn($response);
        
        
        $fbAuth = new FBAuthentication($fb);
        $output = $fbAuth->getUser(['id']);
        
        $this->assertSame($output, $output);
    }
    
    
    /**
     * @expectedException App\Exceptions\FBRequestException
     */
    public function testIfFBUserIsReturnedInvalidException()
    {
        $response = Mockery::mock('FacebookResponse');
        $response->shouldReceive('getGraphObject')
           ->once()
           ->andThrow(new Facebook\Exceptions\FacebookSDKException);
        
        $fb = Mockery::mock('LaravelFacebookSdk');
        $fb->shouldReceive('get')
           ->once()
           ->andReturn($response);
           
        $fbAuth = new FBAuthentication($fb);
        $fbAuth->getUser(['id']);
    }
}