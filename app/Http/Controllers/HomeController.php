<?php

namespace App\Http\Controllers;

use App\ExternalAPI\GeniusLyrics;
use App\ExternalAPI\GeniusSong;
use App\ExternalAPI\LastfmProfile;
use App\ExternalAPI\LastfmRecentTracks;
use App\Models\Lyrics;
use App\Models\Profile;
use App\Models\RecentTracks;
use App\Models\Song;
use Laravel\Lumen\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('index');
    }

    public function loadUser($user, Profile $profile, RecentTracks $recentTracks, Song $song, Lyrics $lyrics)
    {
        //$profile = new Profile();
        $profileAPI = new LastfmProfile($profile, $user);

        //$recentTracks = new RecentTracks();
        $recentTracksAPI = new LastfmRecentTracks($recentTracks, $user);

        //$song = new Song();
        $songAPI = new GeniusSong($song);
        $songAPI->search($recentTracks->getArtist(), $recentTracks->getTrack());

        //$lyrics = new Lyrics();
        $lyricsAPI = new GeniusLyrics($lyrics);
        $lyricsAPI->findLyrics($song->getSongId());

        return view('user', ['profile' => $profile, 'recentTracks' => $recentTracks, 'lyrics' => $lyrics]);
    }

    public function checkTitle($user, RecentTracks $recentTracks)
    {
        $recentTracksAPI = new LastfmRecentTracks($recentTracks, $user);
        return $recentTracks->getTrack();
    }
}
    //
