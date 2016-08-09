<?php namespace Sseffa\VideoApi\Services;

/**
 * Youtube
 *
 * @package Sseffa\VideoApi
 * @author  Sefa Karagöz
 */
class Youtube implements ServicesInterface {

    use ServiceTrait;

    /**
     * Base Channel Url
     *
     * @var String
     */
    //private $baseChannelUrl = 'http://gdata.youtube.com/feeds/api/videos?q={id}&v=2&alt=jsonc';
	private $baseChannelUrl = 'https://www.googleapis.com/youtube/v3/videos?id={id}&key=AIzaSyDkQhl_qAJt8WHDOJpbMLumgCbxdlnVVPE&part=snippet,contentDetails,statistics';

	
    /**
     * Base Video Url
     *
     * @var String
     */
    //private $baseVideoUrl = 'http://gdata.youtube.com/feeds/api/videos/{id}?v=2&alt=jsonc';
	private $baseVideoUrl = 'https://www.googleapis.com/youtube/v3/videos?id={id}&key=AIzaSyDkQhl_qAJt8WHDOJpbMLumgCbxdlnVVPE&part=snippet,contentDetails,statistics';

    /**
     * Id
     *
     * @var String
     */
    private $id;

    /**
     * Get Video Detail
     *
     * @param  string   $id
     * @return mixed
     */
	 
	 
	
	 
	 
	 
	 
	
    public function getVideoDetail($id)
    {
        $this->setId($id);

        $json = $this->getData($this->baseVideoUrl);

		$a = json_decode($json);
	
		$b = $a->items;
		$x = 0;
		$y = 0;
		
		$id = null;
		$title = null;
		$description = null;
		$upload_date = null;
		$thumbnail_small = null;
		$duration = null;
		$view_Count = null;
		$like_Count = null;
		$comment_Count = null;
		
		foreach ( $b as $c ){
			
			$id	= $c->id;
			
			foreach($c as $d){
				
				if($x == 3){
					
					$e = $d->thumbnails;
					foreach($e as $f){
						
						if($y == 0){
							$title				= $d->title;
							$description   		= $d->description;
							$upload_date   		= $d->publishedAt;
							$channelId			= $d->channelId;
							$thumbnail_small	= $f->url;
							$y++;
						}	
					}	
				}
				
				if($x == 4){
					
					// videos de horas de duração - PT5H21M13S (PThhHmmMssS)
					// videos com minutos de duração - PT21M13S (PTmmMssS)
					// videos com segundos de duração - PT13S
					
					
					$duration	=	$d->duration;				
					$duration = ($this->getHoras($duration)*360) + ($this->getMinutos($duration) * 60) + $this->getSegundos($duration);
					
					$duration;
					
				}
				
				if($x == 5){
					
					$view_Count			= $d->viewCount;
					$like_Count			= $d->likeCount;
					$comment_Count		= $d->commentCount;
					
					break;
				}	
				$x++;
			}
		}
		
		
		
		return array(
			'id'              => $id,
            'title'           => $title,
            'description'     => $description,
            'thumbnail_small' => $thumbnail_small,
            'duration'        => $duration,
            'upload_date'     => $upload_date,
            'like_count'      => isset($like_count) ? $like_count: 0,
            'view_count'      => isset($view_count) ? $view_count : 0,
            'comment_count'   => isset($comment_count) ? $comment_count : 0,
			//'uploader'        => $channelId
		
		);
		
		
		
		
		/*
        return array(
            'id'              => $data->id,
            'title'           => $data->title,
            'description'     => $data->description,
            'thumbnail_small' => $data->thumbnail->sqDefault,
            'thumbnail_large' => $data->thumbnail->hqDefault,
            'duration'        => $data->duration,
            'upload_date'     => $data->uploaded,
            'like_count'      => isset($data->likeCount) ? $data->likeCount : 0,
            'view_count'      => isset($data->viewCount) ? $data->viewCount : 0,
            'comment_count'   => isset($data->commentCount) ? $data->commentCount : 0
            'uploader'        => $data->uploader
        );
		
		*/
    }

    /**
     * Get Video List
     *
     * @param   string  $id
     * @return  mixed
     */
    public function getVideoList($id){
        $this->setId($id);

        $list = array();
        $data = $this->getData($this->baseChannelUrl);

        if(!isset($data->data->items)) {
            throw new \Exception("Video channel not found");
        }

        foreach ($data->data->items as $value) {
            $list[$value->id] = array(
                'id'              => $value->id,
                'title'           => $value->title,
                'description'     => $value->description,
                'thumbnail_small' => $value->thumbnail->sqDefault,
                'thumbnail_large' => $value->thumbnail->hqDefault,
                'duration'        => 0,//$value->duration,
                'upload_date'     => $value->uploaded,
                'like_count'      => isset($value->likeCount) ? $value->likeCount : 0,
                'view_count'      => isset($value->viewCount) ? $value->viewCount : 0,
                'comment_count'   => isset($value->commentCount) ? $value->commentCount : 0
            );
        }
        return $list;
    }

	
	
	public function getHoras($duration){
		
		
		// Tiver um H então é um videos de horas de duração
		$teste = strripos($duration, "H");
		$horas = 0;
		if($teste){
			
			$duration = substr($duration, 2, (strlen($duration)));
			echo "<br >Horas: " .$duration;
			
			if(strcmp($duration[1],"H") == 0){
				
				// é H logo tem menos de 10 horas 
				$horas = $duration[0];
				
				
			} else {
				
				// não é H logo tem mais de 10 horas 
				$horas = $duration[0] . $horas = $duration[1];
				
			}
			
		} 
			return $horas;
		
	} 
	
	
	
	
	public function getMinutos($duration){
		
		
		// Tiver um H então é um videos de minutos de duração
		$teste = strripos($duration, "M");
		$minutos = 0;
		
		if($teste){
			
			$pos = strpos($duration, "M");
			echo "<br> Posição: " . $pos;
			
			
			if(strcmp($duration[$pos-2],"H") == 0 || strcmp($duration[$pos-2],"T") == 0){
				
				// é H logo tem menos de 10 minutos 
				$minutos = $duration[$pos-1];
				
				
			} else {
				
				// não é H logo tem mais de 10 minutos 
				$minutos = $duration[$pos-2] . $duration[$pos-1];
				
			}
			
			
		}
		
		return $minutos;
		
	}
	
	public function getSegundos($duration){
		
		
		// Tiver um H então é um videos de minutos de duração
		$teste = strripos($duration, "S");
		$segundos = 0;
		
		if($teste){
			
			$pos = strlen($duration) - 1;
			echo "<br> Posição: " . $pos;
			
			// Caso tenha 
			if(strcmp($duration[$pos-2],"M") == 0 || strcmp($duration[$pos-2],"H") == 0 || strcmp($duration[$pos-2],"T") == 0){
				
				// é H logo tem menos de 10 segundos 
				$segundos = $duration[$pos-1];
				
				
			} else {
				
				// não é H logo tem mais de 10 segundos 
				$segundos = $duration[$pos-2] . $duration[$pos-1];
				
			}
			
			
		}
		
		return $segundos;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
