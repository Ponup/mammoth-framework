<?php declare(strict_types=1);

namespace Mammoth\Audio;

class WaveFileReader
{
    private const HEADER_LENGTH = 44;

    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function read(bool $readData = false): WaveFile
    {
        if (!is_readable($this->filePath)) {
            return false;
        }

        $filesize = filesize($this->filePath);

        //Make sure filesize is sane; e.g. at least the headers should be able to fit in it
        if ($filesize < self::HEADER_LENGTH) {
            return false;
        }

        $handle = fopen($this->filePath, 'rb');

        if ($this->readString($handle, 4) != 'RIFF') {
            throw new \Exception("Unexpected chunk id");
        }

        $waveFile = new WaveFile;
        $waveFile->setHeader([
            'chunksize' => $this->readLong($handle),
        ]);

        if ($this->readString($handle, 4) != 'WAVE') {
            throw new \Exception("Unexpected wave id");
        }

        $waveFile->setSubChunk1([
            'id' => $this->readString($handle, 4),
            'size' => $this->readLong($handle),
            'audioformat' => $this->readWord($handle),
            'numchannels' => $this->readWord($handle),
            'samplerate' => $this->readLong($handle),
            'byterate' => $this->readLong($handle),
            'blockalign' => $this->readWord($handle),
            'bitspersample' => $this->readWord($handle)
        ]);

        $subChunk2 = [
            'id' => $this->readString($handle, 4),
            'size' => $this->readLong($handle),
            'data' => null
        ];
        if ($readData && ($filesize - self::HEADER_LENGTH) == $subChunk2['size']) {
            $subChunk2['data'] = fread($handle, $filesize - self::HEADER_LENGTH);
            $waveFile->setSubChunk2($subChunk2);
        }

        fclose($handle);

        return $waveFile;
    }

    /**
     * Reads a string from the specified file handle
     */
    private function readString($handle, int $length): string
    {
        return $this->readUnpacked($handle, 'a*', $length);
    }

    /**
     * Reads a 32bit unsigned integer from the specified file handle
     */
    private function readLong($handle): int
    {
        return $this->readUnpacked($handle, 'V', 4);
    }

    /**
     * Reads a 16bit unsigned integer from the specified file handle
     */
    private function readWord($handle): int
    {
        return $this->readUnpacked($handle, 'v', 2);
    }

    /**
     * Reads the specified number of bytes from a specified file handle and unpacks it accoring to the specified type
     */
    private function readUnpacked($handle, string $type, int $length)
    {
        $r = unpack($type, fread($handle, $length));
        return array_pop($r);
    }
}
