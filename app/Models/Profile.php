<?php

namespace App\Models;

class Profile
{
    protected $user;
    protected $scrobbles;
    protected $avatar;
    protected $registered;

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
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getScrobbles()
    {
        return $this->scrobbles;
    }

    /**
     * @param mixed $scrobbles
     */
    public function setScrobbles($scrobbles)
    {
        $this->scrobbles = $scrobbles;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param mixed $registered
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;
    }


}
