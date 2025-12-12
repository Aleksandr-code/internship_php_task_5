<?php

namespace App\Generator\MusicLibrary;

class Track
{
    private Melody $melody;
    private VirtualInstrument $virtual_instrument;

    public function __construct( Melody $melody, VirtualInstrument $virtual_instrument ) {
        $this->melody             = $melody;
        $this->virtual_instrument = $virtual_instrument;
    }

    public function export_to( WaveFile $wave_file ) {
        $time_between_samples = $wave_file->get_time_between_samples();
        $max_sample_value     = $wave_file->get_max_absolute_sample_value();

        /** @var Note $note */
        foreach ( $this->melody as $note ) {
            for ( $current_time = 0; $current_time < $note->get_duration(); $current_time += $time_between_samples ) {
                if ( $note->is_pause() ) {
                    $wave_file->write_sample( 0 );
                    continue;
                }

                $normalized_sample_value = $this->virtual_instrument->get_sample_value( $note->get_frequency(), $current_time );
                $sample_value            = $normalized_sample_value * $max_sample_value * 0.9;
                $sample_value            = (int) ceil( $sample_value );
                $wave_file->write_sample( $sample_value );
            }
        }
    }
}
