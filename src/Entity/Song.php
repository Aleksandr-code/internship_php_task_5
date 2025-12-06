<?php

namespace App\Entity;

class Song
{
    private int $id;
    private string $title;
    private string $artist;
    private string $album;
    private string $genre;
    private string $imageFilePath;
    private string $songFilePath;
    private string $lyrics;
    private int $likes;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getArtist(): string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): void
    {
        $this->artist = $artist;
    }

    public function getAlbum(): string
    {
        return $this->album;
    }

    public function setAlbum(string $album): void
    {
        $this->album = $album;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function getImageFilePath(): string
    {
        return $this->imageFilePath;
    }

    public function setImageFilePath(string $imageFilePath): void
    {
        $this->imageFilePath = $imageFilePath;
    }

    public function getSongFilePath(): string
    {
        return $this->songFilePath;
    }

    public function setSongFilePath(string $songFilePath): void
    {
        $this->songFilePath = $songFilePath;
    }

    public function getLyrics(): string
    {
        return $this->lyrics;
    }

    public function setLyrics(string $lyrics): void
    {
        $this->lyrics = $lyrics;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }
}

