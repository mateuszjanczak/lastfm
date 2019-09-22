<?php

namespace App\Models;

class Lyrics
{
    protected $lyrics;

    /**
     * @return mixed
     */
    public function getLyrics()
    {
        return $this->lyrics;
    }

    /**
     * @param mixed $lyrics
     */
    public function setLyrics($lyrics)
    {
        $this->lyrics = $lyrics;
    }


}
