<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

use App\MusicHash\BeatPort\BeatPortAPI;

class IndexController extends Controller
{
    /**
     * Generates homepage
     * 
     * @todo Should be redesigned completely... tmp.
     * @return Response
     */
    public function index()
    {
    	$BPChart = new BeatPortAPI('7', 'trance');
    	$userID = $this->getUser();
    	
        return view('welcome', array(
			'BPChart' => $BPChart->toArray(),
			'categories' => Config::get('beatport.categories')
		));
    }
    
    
    private function getUser()
    {
        $userID = null;
        
        if (Session::has('userID'))
        {
            $userID = Session::get('userID');
            //$userConfig = \App\UserConfig::where('UserID', $userID)->first();
        }
        
        return $userID;
    }
}