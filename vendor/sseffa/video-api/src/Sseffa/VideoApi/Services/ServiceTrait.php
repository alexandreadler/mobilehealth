<?php namespace Sseffa\VideoApi\Services;

/**
 * Class ServiceTrait
 * 
 * @package Sseffa\VideoApi
 * @author  Sefa Karagöz
 */
trait ServiceTrait {

    /**
     * Set Id
     *
     * @param $value
     */
    public function setId($value) 
    {
        $this->id = $value;
    }

    /**
     * Json Data Parser
     *
     * @param   string  $json
     * @return  mixed
     * @throws  \Exception
     */
    public function parseData($json) 
    {
		
        $data = json_decode($json);

        if (json_last_error() === JSON_ERROR_NONE) {            
            return $data;
        }

        throw new \Exception("Video or channel id is not found. (Invalid json)");
    }

    /**
     * Get Video Detail
     *
     * @param   string  $url
     * @return  mixed
     * @throws  \Exception
     */
    public function getData($url) 
    {
        $json = null;  
		$json = @file_get_contents(str_replace('{id}', $this->id, $url));
		
	
		return $json;
        //return $this->parseData($json);
    }
    
}
