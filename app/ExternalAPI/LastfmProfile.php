<?php


namespace App\ExternalAPI;

use App\Models\Profile;

class LastfmProfile extends Curl
{
    const URL = "https://ws.audioscrobbler.com/2.0/";
    private $apiKey;
    private $user;

    public function __construct(Profile $model, $user)
    {
        $this->model = $model;
        $this->user = $user;
        $this->apiKey = env('LASTFM_API_KEY');
        $this->askApiForProfile();
    }

    public function askApiForProfile()
    {
        $method = "user.getInfo";
        $url = $this->buildUrl($method);
        $this->setUrl($url);
        $this->executeQuery();

        if ($this->getStatus()) {
            if (empty($this->getJson()->user)) {
                $redirect = "https://".$_SERVER['SERVER_NAME']."/valejzy";
                //Header("Location: $redirect");
                header( "refresh:3;url=$redirect" );
                die("user not found, redirecting...");
            }
            $rsp = $this->getJson()->user;
            $this->model->setUser($rsp->name);
            $this->model->setScrobbles($rsp->playcount);
            $this->model->setAvatar((($rsp->image[2]->{'#text'}) ? $rsp->image[2]->{'#text'} : "https://lastfm-img2.akamaized.net/i/u/avatar170s/818148bf682d429dc215c1705eb27b98"));
            $this->model->setRegistered(gmdate("m/Y", $rsp->registered->unixtime));
        }
    }

    private function buildUrl($method)
    {
        $data = array(
            'method' => $method,
            'user' => $this->user,
            'api_key' => $this->apiKey,
            'format' => 'json'
        );

        $query = http_build_query($data);
        $url = self::URL . "?" . $query;

        return $url;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
}
