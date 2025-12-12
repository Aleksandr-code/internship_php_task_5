<?php

namespace App\Generator\MusicLibrary;

class WaveFile
{
    private const RIFF = 'RIFF';
    private const WAVE = 'WAVE';
    private const FMT_CHUNK_MARKER = 'fmt ';
    private const FMT_CHUNK_SIZE = 16;
    private const FORMAT_TYPE = 1; // PCM
    private const CHANNELS = 1;
    private const DATA_CHUNK_MARKER = 'data';
    private const TOTAL_HEADER_SIZE = 44;
    private const BITS_PER_SAMPLE = 16;
    private const BUFFER_SIZE = 16384;

    private $file;

    private int $sample_rate;

    private string $buffer = '';

    public function __construct( string $file, int $sample_rate ) {
        $this->file = fopen( $file, "w" );
        $this->sample_rate = $sample_rate;
        $this->create_fmt_chunk();
        $this->create_data_chunk();
    }

    private function write_string( string $string ): void {
        fwrite( $this->file, pack( 'a*', $string ), strlen( $string ) );
    }

    private function write_short( int $value ): void {
        fwrite( $this->file, pack( 'v', $value ), 2 );
    }

    private function write_long( int $value ): void {
        fwrite( $this->file, pack( 'V', $value ), 4 );
    }

    public function write_sample( int $value ): void {
        $this->buffer .= pack( 's', $value );
        $this->flush_buffer( false );
    }

    private function flush_buffer( bool $force ): void {
        if ( '' === $this->buffer ) {
            return;
        }

        $current_buffer_size = strlen( $this->buffer );

        if ( ! $force && ( $current_buffer_size < static::BUFFER_SIZE ) ) {
            return;
        }

        fwrite( $this->file, $this->buffer, $current_buffer_size );
        $this->buffer = '';
    }

    private function create_fmt_chunk(): void {
        $this->write_string( static::RIFF );
        $this->write_long( 0 ); // placeholder (file size)
        $this->write_string( static::WAVE );
        $this->write_string( static::FMT_CHUNK_MARKER );
        $this->write_long( static::FMT_CHUNK_SIZE );
        $this->write_short( static::FORMAT_TYPE );
        $this->write_short( static::CHANNELS );
        $this->write_long( $this->sample_rate );
        $this->write_long( $this->sample_rate * static::BITS_PER_SAMPLE * static::CHANNELS / 8 );
        $this->write_short( static::BITS_PER_SAMPLE * static::CHANNELS / 8 );
        $this->write_short( static::BITS_PER_SAMPLE );
    }

    private function create_data_chunk(): void {
        $this->write_string( static::DATA_CHUNK_MARKER );
        $this->write_long( 0 ); // placeholder (data size)
    }

    private function update_sizes(): void {
        $file_size = fstat( $this->file )['size'];
        fseek( $this->file, 4, SEEK_SET );
        $this->write_long( $file_size );

        fseek( $this->file, 40, SEEK_SET );
        $this->write_long( $file_size - static::TOTAL_HEADER_SIZE );
    }

    public function get_max_absolute_sample_value(): int {
        return 2 ** ( static::BITS_PER_SAMPLE - 1 ) - 1;
    }

    public function get_time_between_samples(): float {
        return 1 / $this->sample_rate;
    }

    public function __destruct() {
        $this->flush_buffer( true );
        $this->update_sizes();
        fclose( $this->file );
    }
}
