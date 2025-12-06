<?php

namespace App\Service;

use App\Entity\Song;

class SongService
{

    public function create($data, $count = 10): array
    {
        $song = new Song();
        $song->setId(1);
        $song->setTitle('Title 1');
        $song->setArtist('Person Name, Band');
        $song->setAlbum('Album 1 | Single');
        $song->setGenre('Genre 1');
        $song->setImageFilePath('src/Image1');
        $song->setSongFilePath('src/Song1');
        $song->setLyrics('Text');
        $song->setLikes(10);

        // ouput data
        $songs[] = $song;

        return $songs;
    }

}
