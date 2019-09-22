<?php


namespace App\ExternalAPI;


abstract class Curl
{
    protected $url;
    protected $cookie;
    protected $handle;
    protected $status;
    protected $data;
    protected $json;
    protected $model;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function executeQuery()
    {
        $this->initConnection();
        $this->data = curl_exec($this->handle);

        if (!curl_errno($this->handle)) {
            $this->status = true;
        } else {
            $this->status = false;
        }
    }

    private function initConnection()
    {
        $this->handle = curl_init();
        curl_setopt($this->handle, CURLOPT_URL, $this->url);
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);
        if (isset($this->cookie)) {
            curl_setopt($this->handle, CURLOPT_COOKIE, $this->cookie);
        }
        curl_setopt($this->handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    }

    /**
     * @return mixed
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @param mixed $cookie
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param mixed $handle
     */
    public function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getJson()
    {
        $this->json = json_decode($this->data);
        return $this->json;
    }

    public function __destruct()
    {
        curl_close($this->handle);
        $this->handle = NULL;
    }
}
