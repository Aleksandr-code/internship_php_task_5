<?php

namespace App\Generator;

use App\Generator\MusicLibrary\Melody;
use App\Generator\MusicLibrary\SineWaveSynth;
use App\Generator\MusicLibrary\Track;
use App\Generator\MusicLibrary\WaveFile;
use Faker;

class AudioCreator
{
    public function audioURLGenerate(Faker\Generator $faker, $seed, $id, $locale):string
    {
        $filename    = $seed . '_' . $id. '_' . $locale .'.wav';
        $filepath    = dirname(__DIR__, 2) . '/public/upload/audio/' . $filename;
        if (file_exists($filepath)){
            return $filename;
        }
        $sample_rate = 48000;

        $wave_file       = new WaveFile( $filepath, $sample_rate );
        $sine_wave_synth = new SineWaveSynth();

        $beats_per_minute = 113;
        $melody           = new Melody( $beats_per_minute );

        $notes = ['C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B'];
        $progression = ['C' => ['C', 'E', 'G'], 'G' => ['G', 'B', 'D'], 'Am' => ['A', 'C', 'E'], 'F' => ['F', 'A', 'C']];


        for($i = 0; $i < 2; $i++){
            $accordC = $faker->shuffle($progression['C']);
            $accordG = $faker->shuffle($progression['G']);
            $accordAm = $faker->shuffle($progression['Am']);
            $accordF = $faker->shuffle($progression['F']);
            for ($y = 0; $y < 2; $y++){
                $melody->add_note($accordC[$y], 8);
            }
            for ($y = 0; $y < 2; $y++){
                $melody->add_note($accordG[$i], 8);
            }
            for ($y = 0; $y < 2; $y++){
                $melody->add_note($accordAm[$i], 8);
            }
            for ($y = 0; $y < 2; $y++){
                $melody->add_note($accordF[$i], 8);
            }
            $melody->add_pause( 4 );
        }

        $track = new Track( $melody, $sine_wave_synth );
        $track->export_to( $wave_file );

        return $filename;
    }
}
