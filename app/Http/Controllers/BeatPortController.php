<?php namespace App\Http\Controllers;

use App\Utils\Time;
use App\Utils\Definitions;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

use App\MusicHash\BeatPort\BeatPortAPI;

/**
 * 
 */
class BeatPortController extends Controller
{
	/**
	 * 
	 */
    public function chart($chartIdentifier)
    {
        $category = $this->getCategory($chartIdentifier);
        
        if (is_null($category))
            return $this->onError($chartIdentifier . ' Not Found!');
        
    	$beatPortChart = new BeatPortAPI($category['id'], $chartIdentifier);
        
        return $beatPortChart->toArray();
    }
    
    
    /**
     * 
     */
    public function genres()
    {
        return Config::get('beatport.categories');
    }
    
    
    /**
     * 
     */
    private function getCategory($category)
    {
        $categories = Config::get('beatport.categories');
        
        return (array_key_exists($category, $categories)) ? $categories[$category] : null;
    }
    
    
    /**
     * 
     */     
    private function onError($errorDesccription)
    {
        return abort(404, $errorDesccription);
    }
}