<?php

namespace App\Generator\MusicLibrary;

class Melody implements \Iterator {
    private float $tempo;

    private array $notes = [];

    private int $current_index = 0;

    public function __construct( float $tempo ) {
        $this->tempo = $tempo;
    }

    private function duration_to_seconds( float $duration ): float {
        return 60 * 4 / $this->tempo / $duration;
    }

    public function add_note( string $pitch, float $duration ): void {
        $note = new Note();
        $note->set_pitch( $pitch );
        $note->set_duration( $this->duration_to_seconds( $duration ) );
        $this->notes[] = $note;
    }

    public function add_pause( float $duration ): void {
        $note = new Note();
        $note->set_duration( $this->duration_to_seconds( $duration ) );
        $note->convert_to_pause();
        $this->notes[] = $note;
    }

    public function rewind(): void {
        $this->current_index = 0;
    }

    public function current(): mixed {
        return $this->notes[ $this->current_index ];
    }

    public function key(): mixed {
        return $this->current_index;
    }

    public function next(): void {
        ++ $this->current_index;
    }

    public function valid(): bool {
        return isset( $this->notes[ $this->current_index ] );
    }
}
