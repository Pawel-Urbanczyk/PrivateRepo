<?php

namespace App\Services;

class Fetcher
{
    private $forbidedenLink;

    public function __construct($forbiddenLink)
    {
        $this->forbidedenLink=$forbiddenLink;
    }

    public function get($url)
    {
        if($url === $this->forbidedenLink){
            return false;
        }
        //get the result from api
        $result=file_get_contents($url);
        return json_decode($result, true);
    }
}
