<?php

namespace App\Generator;

use Faker\Generator;

class FakerSong extends \Faker\Provider\Base
{
    public function songGenre($locale): string
    {
        $genres = require dirname(__DIR__, 2) . '/data/musicGenres.php';
        if (isset($genres[$locale])) {
            return $this->generator->randomElement($genres[$locale]);
        } else {
            return $this->generator->randomElement($genres['en_US']);
        }
    }

    public function songTitle(): string
    {
        $title = $this->generator->realTextBetween(4,12);
        return rtrim($title,'.');
    }

    public function songArtist(): string
    {
        return $this->generator->name();
    }

    public function songAlbum():string
    {
        $rngNumber = $this->generator->numberBetween(1, 3);
        if ($rngNumber > 1) {
            return rtrim($this->generator->realTextBetween(4,12), '.');
        } else {
            return 'Single';
        }
    }

    public function songLyrics(): string
    {
        return $this->generator->realText();
    }





}
