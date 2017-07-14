<?php namespace App\MusicHash\BeatPort;

use GuzzleHttp\Client;
use Concat\Http\Handler\CachedStream;
use Concat\Http\Handler\CacheHandler;
use Doctrine\Common\Cache\FilesystemCache;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

Class BeatPortAPI
{
	private $ID = null;
	private $slug = null;
	private $limit = -1;
	private $response = null;
	
	
    public function __construct($ID, $slug)
	{ 
		$this->ID = $ID;
		$this->slug = $slug;
	}
	
	
	/**
	 * 
	 */
	public function setLimit($limit)
	{
		$this->limit = $limit;
		
		return $this;
	}
	
	
 	/**
	 * 
	 */
	public function toArray()
	{
		$BPData = $this->loadChart();
		
	    list(, $javascriptVars) = explode('data-objects', $BPData);
	    $json = substr($javascriptVars,
	        strpos($javascriptVars, '{'),
	        strpos($javascriptVars, '};') - strpos($javascriptVars, '{')
	        + 1
	    );
	    
	    $chart = json_decode($json, true);
	    
	    if (-1 < $this->limit)
	        $chart['tracks'] = array_slice($chart['tracks'], 0, $this->limit);
	    
	    return $this->mapData($chart['tracks']);
	}
	
	
    /**
     * 
     */
    private function mapData($array = [])
    {
        $tracksList = [];
        
        foreach ($array as $track)
        {
            $tracksList[] = [
                'id' => $track['id'],
                'artist' => $this->getBeatPortArtistToString($track['artists']),
                'title' => $track['title'],
                'label' => $track['label']['name'],
                'mix' => $track['mix'],
                'bpm' => $track['bpm'],
                'price' => $track['price']['value'],
                'duration' => $track['duration']['minutes'],
                'date' => $track['date']['released'],
                'image' => $track['images']['dynamic']['url']
            ];
        }
        
        return $tracksList;
    }
    
    
	/**
	 * 
	 */
	public static function top10($limit = 10)
	{
	    global $config;
	    
	    $tracks = array();
	    
	    foreach ($config['beatport']['categories'] as $slug => $category)
		{
	        $tracks[$slug] = (new self($slug, $category['id']))
				->setLimit($limit)
				->toJson();
	    }
	    
	    return $tracks;
	}
	
	
	/**
	 * 
	 */
	public static function getBeatPortArtistToString($artistsArray = array())
	{
	    $out = array();
	    
	    foreach ($artistsArray as $artist) {
	        array_push($out, $artist['name']);
	    }
	    
	    return implode(' & ', $out);
	}
	
	
	/**
	 * @todo make cleaner the query building thing.
	 */
	private function getCategoryURL()
	{
		return str_replace(array('{slug}', '{ID}'), array($this->slug, $this->ID), Config::get('beatport.chart_url'));
	}
	
	
	/**
	 * 
	 */
	private function loadChart()
	{
		// Basic directory cache example
		$cacheProvider = new FilesystemCache(Config::get('beatport.cache.tmp_dir'));
		$defaultHandler = null;
		
		// Create a cache handler with a given cache provider and default handler.
		$handler = new CacheHandler($cacheProvider, $defaultHandler, Config::get('beatport.cache'));
		
		$client = new Client([
			'handler' => $handler,
			'headers' => [
				'User-Agent' => Config::get('beatport.user_agent')
			]
		]);
		
		$res = $client->get($this->getCategoryURL());
		
		return $res->getBody();
	}
}