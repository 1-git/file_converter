<?php

namespace TestTask\Generator;

use TestTask\Generator\Additional\SilencesInterval;
use TestTask\Generator\Structure\Book;

interface SegmentGeneratorInterface
{
    /**
     * @param Book $book
     * @return SilencesInterval[]
     */
    public function getSegments(Book $book): array;
}
