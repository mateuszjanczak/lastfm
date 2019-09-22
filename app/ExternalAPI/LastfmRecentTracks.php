<?php


namespace App\ExternalAPI;

use App\Models\RecentTracks;
use App\Helpers\Time;

class LastfmRecentTracks extends Curl
{
    const URL = "https://ws.audioscrobbler.com/2.0/";
    private $apiKey;
    private $user;

    public function __construct(RecentTracks $model, $user)
    {
        $this->model = $model;
        $this->user = $user;
        $this->apiKey = env('LASTFM_API_KEY');
        $this->askApiForRecentTracks();
    }

    public function askApiForRecentTracks()
    {
        $method = "user.getrecenttracks";
        $url = $this->buildUrl($method);
        $this->setUrl($url);
        $this->executeQuery();

        if ($this->getStatus()) {
            $rsp = $this->getJson()->recenttracks;
            if (isset($rsp->track[0]->{'@attr'}->nowplaying)) {
                $this->model->setArtist($rsp->track[0]->artist->{'#text'});
                $this->model->setTrack($rsp->track[0]->name);
                $this->model->setMiniature((($rsp->track[0]->image[2]->{"#text"}) ? $rsp->track[0]->image[2]->{"#text"} : "https://lastfm-img2.akamaized.net/i/u/174s/2a96cbd8b46e442fc41c2b86b821562f.png"));
                $this->model->setScrobblingNow(true);
            }
            $data = array();
            foreach ($rsp->track as $key => $value) {
                $temp = array(
                    "artist" => $value->artist->{"#text"},
                    "track" => $value->name,
                    "miniature" => (($value->image[2]->{"#text"}) ? $value->image[2]->{"#text"} : "https://lastfm-img2.akamaized.net/i/u/174s/2a96cbd8b46e442fc41c2b86b821562f.png"),
                    "date" => ((isset($value->date->uts)) ? Time::toTimeAgo($value->date->uts) : "Now")
                );
                array_push($data, $temp);
            }
            $this->model->setTracks($data);
        }
    }

    private function buildUrl($method)
    {
        $data = array(
            'method' => $method,
            'user' => $this->user,
            'api_key' => $this->apiKey,
            'format' => 'json',
            'limit' => 5
        );

        $query = http_build_query($data);
        $url = self::URL . "?" . $query;

        return $url;
    }
}
