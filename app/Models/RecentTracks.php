<?php

namespace App\Models;

class RecentTracks
{
    protected $scrobblingNow;
    protected $artist;
    protected $track;
    protected $miniature;
    protected $tracks;

    /**
     * @return mixed
     */
    public function getScrobblingNow()
    {
        return $this->scrobblingNow;
    }

    /**
     * @param mixed $scrobblingNow
     */
    public function setScrobblingNow($scrobblingNow)
    {
        $this->scrobblingNow = $scrobblingNow;
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return mixed
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * @param mixed $track
     */
    public function setTrack($track)
    {
        $this->track = $track;
    }

    /**
     * @return mixed
     */
    public function getMiniature()
    {
        return $this->miniature;
    }

    /**
     * @param mixed $miniature
     */
    public function setMiniature($miniature)
    {
        $this->miniature = $miniature;
    }

    /**
     * @return mixed
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * @param mixed $tracks
     */
    public function setTracks($tracks)
    {
        $this->tracks = $tracks;
    }


}
