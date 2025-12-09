<?php

namespace App\Service;

use App\Entity\Song;
use App\Generator\FakerSong;
use App\Generator\ImageCretor;
use Faker;

class SongService
{
    public function create($data, $count = 2): array
    {
        $faker = $this->fakerSetup($data);
        $imageCretor = new ImageCretor();

        $songs = [];
        for ($i = 0; $i < $count; $i++) {
            $song = new Song();
            $songArtist = $faker->songArtist();
            $songAlbum = $faker->songAlbum();

            $song->setId($i+1);
            $song->setTitle($faker->songTitle());
            $song->setArtist($songArtist); // Person Name, Band
            $song->setAlbum($songAlbum); // Album 1 | Single
            $song->setImageFilePath($imageCretor->imageURLGenerate($faker, $songAlbum, $songArtist));// $this->imageURLGenerate($faker)
            $song->setGenre($faker->songGenre($data['locale'])); // 'Genre 1'
            $song->setSongFilePath('src/Song1');
            $song->setLyrics($faker->songLyrics());
            $song->setLikes(1);
            $songs[] = $song;
        }

        return $songs;
    }

    public function fakerSetup($data): Faker\Generator
    {
        $faker = Faker\Factory::create();
        $rngSeed = $data['seed'] * $data['currentPage'];
        $faker->seed($rngSeed);
        $faker->addProvider(new FakerSong($faker));
        return $faker;
    }

}
