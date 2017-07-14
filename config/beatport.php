<?php

return [
    /**
     *
     */
    'chart_url' => 'https://www.beatport.com/genre/{slug}/{ID}/top-100',
    
    
    /**
     *
     */
    'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4',
    
    
    /**
     * 
     */
    'cache' => [
    	'tmp_dir' => '/tmp',
	    'methods' => ['GET', 'POST'],
	    'expire' => 60 * 60 * 18,
	    'filter' => null
	],
	
	
	/**
	 * 
	 */
    'categories' => [
        'drum-and-bass' => ['id' => 1, 'title' => 'Drum & Bass'],
        'hardcore-hard-techno' => ['id' => 2, 'title' => 'Hardcore / Hard Techno'],
        'electronica' => ['id' => 3, 'title' => 'Electronica'],
        'house' => ['id' => 5, 'title' => 'House'],
        'techno' => ['id' => 6, 'title' => 'Techno'],
        'trance' => ['id' => 7, 'title' => 'Trance'],
        'hard-dance' => ['id' => 8, 'title' => 'Hard Dance'],
        'breaks' => ['id' => 9, 'title' => 'Breaks'],
        'chill-out' => ['id' => 10, 'title' => 'Chill Out'],
        'tech-house' => ['id' => 11, 'title' => 'Tech House'],
        'deep-house' => ['id' => 12, 'title' => 'Deep House'],
        'psy-trance' => ['id' => 13, 'title' => 'Psy Trance'],
        'minimal' => ['id' => 14, 'title' => 'Minimal'],
        'progressive-house' => ['id' => 15, 'title' => 'Progressive House'],
        'dj-tools' => ['id' => 16, 'title' => 'DJ Tools'],
        'electro-house' => ['id' => 17, 'title' => 'Electro House'],
        'dubstep' => ['id' => 18, 'title' => 'Dubstep'],
        'indie-dance-nu-disco' => ['id' => 37, 'title' => 'Indie Dance / Nu-Disco'],
        'hip-hop' => ['id' => 38, 'title' => 'Hip-Hop'],
        'pop-rock' => ['id' => 39, 'title' => 'Pop / Rock'],
        'funk-r-and-b' => ['id' => 40, 'title' => 'Funk / R&B'],
        'reggae-dub' => ['id' => 41, 'title' => 'Reggae Dub'],
        'glitch-hop' => ['id' => 49, 'title' => 'Glitch Hop']
    ]
];