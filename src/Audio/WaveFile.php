<?php declare(strict_types=1);

namespace Mammoth\Audio;

class WaveFile
{
    private array $header;

    private array $subChunk1;

    private array $subChunk2;

    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    public function setSubChunk1(array $subChunk1): void
    {
        $this->subChunk1 = $subChunk1;
    }

    public function setSubChunk2(array $subChunk2): void
    {
        $this->subChunk2 = $subChunk2;
    }

    public function getSampleRate(): int
    {
        return $this->subChunk1['samplerate'];
    }

    public function getNumChannels(): int
    {
        return $this->subChunk1['numchannels'];
    }

    public function getBitsPerSample(): int
    {
        return $this->subChunk1['bitspersample'];
    }

    public function getData(): string
    {
        return $this->subChunk2['data'];
    }

    public function getAudioFormat(): string
    {
        switch ($this->subChunk1['audioformat']) {
            case 0x0001:
                return 'WAVE_FORMAT_PCM';
            case 0x0003:
                return 'WAVE_FORMAT_IEEE_FLOAT';
            case 0x0006:
                return 'WAVE_FORMAT_ALAW';
            case 0x0007:
                return 'WAVE_FORMAT_MULAW';
            case 0xFFFE:
                return 'WAVE_FORMAT_EXTENSIBLE';
            default:
                throw new \Exception('Invalid format id: ' . $this->subChunk1['audioformat']);
        }
    }
}
