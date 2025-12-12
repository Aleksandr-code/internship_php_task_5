<?php

namespace App\Generator\MusicLibrary;
class Note
{
    private const PITCH_TO_FREQUENCY = [
        'C'  => 261.625565300598634,
        'C#' => 277.182630976872096,
        'D'  => 293.664767917407560,
        'D#' => 311.126983722080910,
        'E'  => 329.627556912869929,
        'F'  => 349.228231433003884,
        'F#' => 369.994422711634398,
        'G'  => 391.995435981749294,
        'G#' => 415.304697579945138,
        'A'  => 440,
        'A#' => 466.163761518089916,
        'B'  => 493.883301256124111,
    ];

    private bool $is_pause = false;
    private float $duration;

    private float $frequency;

    public function is_pause(): bool {
        return $this->is_pause;
    }

    public function convert_to_pause(): void {
        $this->is_pause = true;
    }

    public function get_duration(): float {
        return $this->duration;
    }

    public function set_duration( float $duration ): void {
        $this->duration = $duration;
    }

    public function set_pitch( string $pitch ): void {
        if ( ! isset( static::PITCH_TO_FREQUENCY[ $pitch ] ) ) {
            throw new \InvalidArgumentException( 'Invalid pitch.' );
        }

        $this->frequency = static::PITCH_TO_FREQUENCY[ $pitch ];
    }

    public function get_frequency(): float {
        return $this->frequency;
    }

}
