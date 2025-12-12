<?php

namespace App\Generator\MusicLibrary;
class SineWaveSynth implements VirtualInstrument
{
    public function get_sample_value( float $frequency, float $current_time ): float {
        return sin( 2 * M_PI * $frequency * $current_time );
    }
}
