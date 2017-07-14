<?php namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Time;
use App\Utils\Definitions;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\FBAuthentication;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

use App\Exceptions\FBRequestException;
use App\Exceptions\FBAuthenticationTokenException;
use App\Exceptions\FBAuthenticationTokenInvalidException;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

/**
 * Login class is responsible for handling the logins - currently services only facebook logins.
 * for both Agent logins and User logins
 */
class LoginController extends Controller
{
    /**
     * 
     * @param LaravelFacebookSdk $fb
     * @return Response
     */
    public function fbLogin(LaravelFacebookSdk $fb)
    {
        $currentUrl = Request::path();
        $fbAuth = new FBAuthentication($fb);
        
        // extract token from url
        try
        {
            $accessToken = $fbAuth->getAccessTokenFromRedirect($currentUrl);
        } catch(FBAuthenticationTokenException $e)
        {
            //@todo add loggs
            // failed to auth
            return redirect('/')-with('message', array(
                'message' => 'auth failed',
                'type' => 'fatal'
            ));
        } catch(FBAuthenticationTokenInvalidException $e)
        {
            $loginUrl = $fb->getLoginUrl(
                Config::get('laravel-facebook-sdk.default_scope'),
                $currentUrl
            );
            
            return redirect()->to($loginUrl);
        }
        
        // extend token
        try
        {
            $accessToken = $fbAuth->extendAccessToken($accessToken);
        } catch(FBAuthenticationTokenException $e)
        {
            //@todo add loggs
            // failed to auth
            return redirect('/')-with('message', array(
                'message' => 'token failed',
                'type' => 'fatal'
            ));
        }
        
        $fb->setDefaultAccessToken($accessToken);
        
        // create user from FB object
        try
        {
            $fbUserObj = $fbAuth->getUser();
            
            $this->create([
                'fbID' => $fbUserObj->getProperty('id'),
                'name' => $fbUserObj->getProperty('name'),
                'email' => $fbUserObj->getProperty('email'),
                'gender' => $fbUserObj->getProperty('gender'),
                'ageRange' => $fbUserObj->getProperty('age_range'),
                'accessToken' => $accessToken
            ]);
            
        } catch(FBRequestException $e)
        {
            //@todo add loggs
        }
        
        return redirect()->route('GOTO_HOMEPAGE');
    }

    
    /**
     * Creates user/agent from a FBUser object - updates if found in the local db.
     *
     * @param array $fbUser
     * @param string/null $agentHash
     */
    private function create($fbUser)
    {
        $User = $this->getUser($fbUser);
        
        // when agent not found, meaning it's a member - store it.
        Session::put('userID', $User->userID);
    }
    
    
    /**
     * Getter for Agent.
     * Since 1 agent can be controlled from 2 diffrent members, in theory. Token should be
     * updated for all the fbIDs found in the system.
     *
     * @param array $fbUser
     * @param int $parentUserID
     * @return Agent instance
     */
    private function getAgent($fbUser, $parentUserID)
    {
        try
        {
            $Agent = Agent::getByFBUser($fbUser['fbID'], $parentUserID);
            
            if (!is_null($Agent))
            {
                // update token for all users
                Agent::where('fbID', $fbUser['fbID'])
                    ->update(['accessToken' => $fbUser['accessToken']]);
                
                return $Agent;
            }
            
            $Agent = new Agent;
            $Agent->agentOf = $parentUserID;
            $Agent->fbID = $fbUser['fbID'];
            $Agent->accessToken = $fbUser['accessToken'];
            $Agent->name = $fbUser['name'];
            $Agent->email = $fbUser['email'];
            $Agent->gender = $fbUser['gender'];
            $Agent->ageRange = $fbUser['ageRange'];
            $Agent->enabled = true;
            $Agent->save();
            
        } catch(\PDOException $e) {
            //@todo add loggs
        }
        
        return $Agent;
    }
    
    
    /**
     * Getter for User.
     * Extracts the user from the table or creates one from the $fbUser data
     *
     * @param array $fbUser
     * @param string/null $agentHash
     * @return Agent instance
     */
    private function getUser($fbUser)
    {
        $User = User::getByFB($fbUser['fbID']);
        
        if (!is_null($User))
        {
            User::where('userID', $User->userID)
                ->update(['lastLogin' => Time::getDateTime()]);
            
            return $User;
        }
        
        try
        {
            $User = new User;
            $User->userType = Definitions::USER_TYPE_MEMBER;
            $User->fbID = $fbUser['fbID'];
            $User->name = $fbUser['name'];
            $User->email = $fbUser['email'];
            $User->lastLogin = Time::getDateTime();
            $User->enabled = true;
            $User->save();
            
        } catch(\PDOException $e) {
            //@todo add loggs
        }
        
        return $User;
    }
}