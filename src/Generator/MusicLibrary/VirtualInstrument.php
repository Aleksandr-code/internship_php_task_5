<?php

namespace App\Generator\MusicLibrary;

interface VirtualInstrument
{
    public function get_sample_value( float $frequency, float $current_time ): float;
}
