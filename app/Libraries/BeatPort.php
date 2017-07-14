<?php namespace App\Libraries;

use Exception;
use DOMDocument;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use GuzzleHttp\Client;
use Concat\Http\Handler\CachedStream;
use App\MusicHash\BeatPort\Middleware\BPCacher;
use Doctrine\Common\Cache\FilesystemCache;


/**
 * 
 */
class BeatPort
{
	private $url = 'http://www.solar.org.il/?{slug}';
	//private $url = 'https://pro.beatport.com/genre/{slug}/{ID}/top-100';	
	private $ua = 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4';
	
	
    public function __construct()
	{ 
		$this->init();
	}
    
    
    private function init()
	{
		$categorySlug = 'psy-trance';
		$categoryID = 13;
		
		/*	
		$stack = HandlerStack::create(function(ResponseInterface $response) {
			print_r($response);
			die($response->getBody());
		    $dom = new DOMDocument;
		    $dom->preventWhiteSpace = false;
		    $dom->validateOnParse = false;
		    $dom->formatOutput = true;
		    $dom->loadHTML($response->getBody());
		    
		    $javascriptVars = $dom->getElementById('data-objects')->nodeValue;
		    $json = substr($javascriptVars,
		        strpos($javascriptVars, '{'),
		        strpos($javascriptVars, '};') - strpos($javascriptVars, '{')
		        + 1
		    );
		 	
			return new FulfilledPromise(
				(new Response())->withBody($json)
			);
		});
		*/
		
		/*
		$stack->push(Middleware::mapResponse(function(ResponseInterface $response) {
			return (new Response())
				->setStatusCode($response->getStatusCode())
				->withBody(\GuzzleHttp\Psr7\stream_for($response->getBody()->read(300)));
		}));
		*/
		
		$url = str_replace(array('{slug}', '{ID}'), array($categorySlug, $categoryID), $this->url);
		
		// Basic directory cache example
		$cacheProvider = new FilesystemCache('/tmp');
		
		// Guzzle will determine an appropriate default handler if `null` is given.
		$defaultHandler = null;
		
		// Create a cache handler with a given cache provider and default handler.
		$handler = new BPCacher($cacheProvider, $defaultHandler, [
		
		    /**
		     * @var array HTTP methods that should be cached.
		     */
		    'methods' => ['GET'],
		
		    /**
		     * @var integer Time in seconds to cache a response for.
		     */
		    'expire' => 60*60*18,
		
		    /**
		     * @var callable Accepts a request and returns true if it should be cached.
		     */
		    'filter' => null,
		]);
		
		$client = new Client([
			'handler' => $handler,
			'headers' => [
				'User-Agent' => $this->ua
			]			
		]);
		
		$res = $client->get($url);
		$body = $res->getBody();	
		
		echo $res->getStatusCode();
		
		print_r($body);
		
		// {"type":"User"...'
		die();
	}
    
    
	public function getBeatPortChart($categorySlug, $categoryID, $limit = -1)
	{
	    
	    
	    $html = getData($url);
	    

	    
	    $chart = json_decode($json, true);
	    
	    if (-1 < $limit)
	        $chart['tracks'] = array_slice($chart['tracks'], 0, $limit);
	    
	    return $chart['tracks'];
	}
	
	
	public function top10($limit = 10)
	{
	    global $config;
	    
	    $tracks = array();
	    
	    foreach ($config['beatport']['categories'] as $slug => $category) {
	        $tracks[$slug] = getBeatPortChart($slug, $category['id'], $limit);
	    }
	    
	    return $tracks;
	}
	
	
	public function getBeatPortArtistToString($artistsArray = array()) {
	    $out = array();
	    
	    foreach ($artistsArray as $artist) {
	        array_push($out, $artist['name']);
	    }
	    
	    return implode(' & ', $out);
	}
}