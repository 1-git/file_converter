<?php

namespace TestTask\InputLoader;

use Exception;
use Generator;
use TestTask\Generator\Additional\SilencesInterval;
use XMLReader;

class XmlInputLoader implements InputLoaderInterface
{
    /**
     * @var string
     */
    protected string $inputFile;

    /**
     * @param string $inputFile
     */
    public function __construct(string $inputFile)
    {
        $this->inputFile = $inputFile;
    }

    /**
     * @return Generator|SilencesInterval[]
     * @throws Exception
     */
    public function getSilences(): Generator
    {
        $reader = new XMLReader();
        if (!$reader->open($this->inputFile)) {
            throw new Exception(sprintf('Failed to open %s', $this->inputFile));
        }
        while ($reader->read()) {
            if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'silence') {
                $from = $reader->getAttribute('from');
                $until = $reader->getAttribute('until');

                yield new SilencesInterval($from, $until);
            }
        }
        $reader->close();
    }
}
