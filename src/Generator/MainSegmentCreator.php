<?php

namespace TestTask\Generator;

use TestTask\InputLoader\InputLoaderInterface;
use TestTask\OutputSaver\OutputSaverInterface;

class MainSegmentCreator implements MainSegmentCreatorInterface
{
    /**
     * @var InputLoaderInterface
     */
    protected InputLoaderInterface $inputLoader;

    /**
     * @var OutputSaverInterface
     */
    protected OutputSaverInterface $outputSaver;

    /**
     * @var BookGeneratorInterface
     */
    protected BookGeneratorInterface $bookGenerator;

    /**
     * @var SegmentGeneratorInterface
     */
    protected SegmentGeneratorInterface $segmentGenerator;

    /**
     * @param InputLoaderInterface $inputLoader
     * @param OutputSaverInterface $outputSaver
     * @param BookGeneratorInterface $bookGenerator
     * @param SegmentGeneratorInterface $segmentGenerator
     */
    public function __construct(
        InputLoaderInterface      $inputLoader,
        OutputSaverInterface      $outputSaver,
        BookGeneratorInterface    $bookGenerator,
        SegmentGeneratorInterface $segmentGenerator
    )
    {
        $this->inputLoader = $inputLoader;
        $this->outputSaver = $outputSaver;
        $this->bookGenerator = $bookGenerator;
        $this->segmentGenerator = $segmentGenerator;
    }

    public function createSegments(): void
    {
        $silences = $this->inputLoader->getSilences();
        foreach ($silences as $silence) {
            $this->bookGenerator->addSilence($silence);
        }
        $book = $this->bookGenerator->getBook();
        $segments = $this->segmentGenerator->getSegments($book);
        $this->outputSaver->saveContent($segments);
    }
}
