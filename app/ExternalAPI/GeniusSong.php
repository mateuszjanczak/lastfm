<?php


namespace App\ExternalAPI;

use App\Models\Song;

class GeniusSong extends Curl
{
    const URL = "https://api.genius.com/search";
    private $apiKey;

    public function __construct(Song $model)
    {
        $this->model = $model;
        $this->apiKey = env('GENIUS_API_KEY');
    }

    public function search($artist, $track)
    {
        $trackShort = mb_substr($track, 0, 5);
        $query = $artist . " " . $trackShort;
        $url = $this->buildUrl($query);

        $this->setUrl($url);
        $this->executeQuery();

        if ($this->getStatus()) {
            $rsp = $this->getJson();
            $temp = 0;
            foreach ($rsp->response->hits as $value) {
                similar_text($value->result->title, $track, $percent);
                if ($percent > $temp && $percent > 90) {
                    $temp = $percent;
                    $this->model->setSongId($value->result->id);
                    break;
                }
            }
        }
    }

    private function buildUrl($query)
    {
        $data = array(
            'access_token' => $this->apiKey,
            'q' => $query
        );

        $query = http_build_query($data);
        $url = self::URL . "?" . $query;

        return $url;
    }
}
