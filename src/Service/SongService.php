<?php

namespace App\Service;

use App\Entity\Song;
use App\Generator\FakerSong;
use App\Generator\ImageCretor;
use Faker;

class SongService
{
    public function create($locale, $seed, $avgLikes, $page, $count = 15): array
    {
        $faker = $this->fakerSetup($locale, $seed, $page);
        $imageCretor = new ImageCretor();

        $likes = $faker->shuffle($this->generateLikes($avgLikes, $count));

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
            $song->setGenre($faker->songGenre($locale)); // 'Genre 1'
            $song->setSongFilePath('src/Song1');
            $song->setLyrics($faker->songLyrics());
            $song->setLikes($likes[$i]);
            $songs[] = $song;
        }

        return $songs;
    }

    public function fakerSetup($locale, $seed, $page): Faker\Generator
    {
        $faker = Faker\Factory::create($locale);
        $rngSeed = $seed * $page;
        $faker->seed($rngSeed);
        $faker->addProvider(new FakerSong($faker));
        return $faker;
    }

    public function generateLikes($avgLikes, $count): array
    {
        $minValue = floor($avgLikes);
        $maxValue = ceil($avgLikes);

        $difference = $avgLikes - $minValue;
        if ($difference === 0.0){
            return array_fill(0, $count, $minValue);
        }

        $percent = ($difference / ($maxValue - $minValue)) * 100;

        $elementsMinCount = round(($percent / 100) * $count);
        $elementsMaxCount = $count - $elementsMinCount;

        $likes = array_merge(
            array_fill(0, $elementsMinCount, $maxValue),
            array_fill(0, $elementsMaxCount, $minValue)
        );

        return $likes;
    }

}
