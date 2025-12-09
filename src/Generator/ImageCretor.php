<?php

namespace App\Generator;

use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Typography\FontFactory;
use Faker;

class ImageCretor
{
    public function imageURLGenerate(Faker\Generator $faker, string $songAlbum, string $artistName):string
    {
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $rgbColor = $faker->hexColor();
        $image = $manager->create(200, 200)->fill($rgbColor);

        $icon = $this->getRandomIcon($faker, $manager);
        $image->place($icon, 'center');

        $albumText = strtoupper($songAlbum);
        $image->text($albumText, 100, 30, function (FontFactory $font) use ($albumText) {
            $this->applyTextStyleSongAlbum($font, $albumText);
        });

        $image->text($artistName, 100, 165, function (FontFactory $font) use ($artistName) {
            $this->applyTextStyleArtistName($font, $artistName);
        });

        $imageFilename = $faker->uuid() . '.jpg';
        $imageFilePath = dirname(__DIR__, 2) . '/public/upload/' . $imageFilename;

        $image->toJpeg()->save($imageFilePath);
        return $imageFilename;
    }

    public function getRandomIcon(Faker\Generator $faker,ImageManager  $imageManager): ImageInterface
    {
        $icons = array_slice(scandir(dirname(__DIR__, 2) . '/data/collection-icons/'), 2);
        $randomIcon = $faker->randomElement($icons);
        $iconFilePath = dirname(__DIR__, 2) . '/data/collection-icons/' . $randomIcon;
        $icon = $imageManager->read($iconFilePath)->resize(80, 80);
        return $icon;
    }

    public function applyTextStyleSongAlbum(FontFactory $font, string $songAlbum): void
    {
        $font->filename(dirname(__DIR__, 2) . '/data/fonts/DK Hand.ttf');
        $font->color('000');
        $font->stroke('fff', 2);
        $font->align('center');
        $font->valign('middle');
        if (strlen($songAlbum) > 4 && strlen($songAlbum) < 10){
            $font->size(50);
        } else {
            $font->size(28);
        }
    }

    public function applyTextStyleArtistName(FontFactory $font, string $artistName): void
    {
        $font->filename(dirname(__DIR__, 2) . '/data/fonts/RadiantKingdom.ttf');
        $font->color('000');
        $font->align('center');
        $font->stroke('fff', 1);
        $font->valign('middle');
        if (strlen($artistName) > 4 && strlen($artistName) < 10){
            $font->size(40);
        } else {
            $font->size(28);
        }
    }


}
