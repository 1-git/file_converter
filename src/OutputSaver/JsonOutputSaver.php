<?php

namespace TestTask\OutputSaver;

use TestTask\Generator\Additional\BookSegment;

class JsonOutputSaver implements OutputSaverInterface
{
    /**
     * @var string
     */
    protected string $outputFile;

    /**
     * @param string $outputFile
     */
    public function __construct(string $outputFile)
    {
        $this->outputFile = $outputFile;
    }

    /**
     * @inheritDoc
     */
    public function saveContent(array $segments): void
    {
        $content = [
            'segments' => array_map(function (BookSegment $object) {
                return [
                    'title' => $object->getTitle(),
                    'offset' => $object->getOffset(),
                ];
            }, $segments),
        ];

        file_put_contents($this->outputFile, json_encode($content));
    }
}
