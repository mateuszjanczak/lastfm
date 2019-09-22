<?php


namespace App\ExternalAPI;

use App\Models\Lyrics;

class GeniusLyrics extends Curl
{
    const URL = "https://genius.com/api/songs";
    private $lyrics;

    public function __construct(Lyrics $model)
    {
        $this->model = $model;
        $this->cookie = env('GENIUS_COOKIE');
    }

    public function findLyrics($songId){
        $url = self::URL."/".$songId."/lyrics_for_edit_proposal";

        $this->setUrl($url);
        $this->setCookie($this->cookie);
        $this->executeQuery();

        if($this->getStatus()){
            $rsp = $this->getJson();
            if(isset($rsp->response->lyrics_for_edit_proposal->body->plain)){
                $this->model->setLyrics($rsp->response->lyrics_for_edit_proposal->body->plain);
            }
        }
    }
}
