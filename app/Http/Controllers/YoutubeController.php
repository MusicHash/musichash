<?php namespace App\Http\Controllers;

use App\Utils\Time;
use App\Utils\Definitions;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\FBAuthentication;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

use Alaouy\Youtube\Youtube;
/**
 */
class YoutubeController extends Controller
{
	/**
	 * 
	 */
    public function search($string)
    {
    	$youtube = new Youtube(Config::get('youtube.sdk_key'));
    	
    	$query = [
			'q' => $string,
			'type' => 'video',
			'part' => 'id',
			'maxResults' => 15
		];
		
		$search = $youtube->searchAdvanced($query, true);
	    
	    return $search['results'][0]->id->videoId;
    }
}