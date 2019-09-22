<?php

namespace App\Models;

class Song
{
    protected $songId;

    /**
     * @return mixed
     */
    public function getSongId()
    {
        return $this->songId;
    }

    /**
     * @param mixed $songId
     */
    public function setSongId($songId)
    {
        $this->songId = $songId;
    }


}
