<?php

/*

 VimeoLoader for MODX Revolution
 =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
 
 VimeoLoader for MODX Revolution is an add-on for the MODX Content Managment System which
 uses the Vimeo api to find a display videos based on a vimeo user ID.
 
 ** CAUTION **
 This is pre-release software and should likely not be used in a production environment
 
 

*/

class VimeoLoader {
    
    private $modx;
    private $user;
    private $requestUrl;
    private $videoFeed;
    private $request;
    private $format;
    private $featuredID;
    
    function __construct(&$modx,$user='user7374360') {
    
        $this->modx = $modx;
        $this->user = $user;
        $this->requestUrl = 'http://vimeo.com/api/v2/'.$this->user.'/';
        $this->format = 'json';
        $this->request = 'videos';
        $this->videoFeed = ''; 
        $this->featuredID = '';

        $this->output = '';
        
        // populates the video feed data
        $this->getVideos();
       
    }
    
    private function getVideos() {
    
        $requeststring = $this->requestUrl . $this->request . '.' . $this->format;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $requeststring);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $json = curl_exec($c);
        
        // dump data to associative array 
        $data = json_decode($json,1);        
		
		$this->videoFeed = $data;
    }
    
    public function getAllVideos($vid='',$w=400,$h=275) {
       
       	$this->featuredID = $vid;
        $output = '';
        $allvids = '';
        $i = 0;
        $w = 0;
        
        foreach($this->videoFeed as $video) {
        	$data = array();
        		$data['vid'] = $video['id'];
        		if ($this->featuredID == '') {
        		
        			$this->featuredID = $data['vid'];
        			
        		}
        		
        		$data['src'] = $video['thumbnail_medium'];
        		$data['videotitle'] = $video['title'];
        		$data['description'] = $video['description'];
        		$data['width'] = $w;
        		$data['height'] = $h;
        		
        		$data['current'] = ($data['vid'] == $this->featuredID) ? 'current-video' : '';
        		$data['currenttag'] = ($data['vid'] == $this->featuredID) ? $this->modx->getChunk('vimeoCurrentFlag') : '';
        		$allvids .= $this->modx->getChunk('vimeoVideoThumbTpl',$data);
   	    
        $i++;
        $w++; // number of videos written
        } // end foreach
      
        $output = $this->modx->getChunk('vimeoFeedWrapperTpl',array('content' => $allvids));
		return $output;
        
    }
    
    public function getFeaturedVideo($vid='',$w=675,$h=380,$wrapper='featuredVideoWrapperTpl') {	
        
        $videoInfo = array();
        
    	if ($vid != '') {	
            
            $videoInfo['id'] = $vid;
            
            /*
            foreach($this->videoFeed as $video) {
    		
    			if ($video['id'] == $vid) {
    				$videoInfo = $video;
    				$this->featuredID = $vid;				
    			} else {
    			     $videoInfo['id'] = $vid;
    			}  			
    		  } // end foreach   	
            */	

    	} else {
    		$videoInfo = $this->videoFeed[0];
    	} // end if...else
    	$data = array();
    	$output = '';
    	
        $data['vid']= $videoInfo['id'];
    	$data['width'] = $w;
    	$data['height'] = $h;
    	
    	
    	$video = array();
    	$video['content'] = $this->modx->getChunk('vimeoVideoIFrameTpl',$data);    
    	
    	if ($wrapper != '') {
    		if ($output = $this->modx->getChunk('featuredVideoWrapperTpl',$video)) {
    			return $output;
    		} else {
    			$output = $video['content'];
    			return $output;
    		}
    	} else {
    		$output = $video['content'];
    		return $output;
    	}
    
    } // end getFeaturedVideo
    
}

?>
