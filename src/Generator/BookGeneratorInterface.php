<?php

namespace TestTask\Generator;

use TestTask\Generator\Additional\SilencesInterval;
use TestTask\Generator\Structure\Book;

interface BookGeneratorInterface
{
    /**
     * @param SilencesInterval $silence
     */
    public function addSilence(SilencesInterval $silence): void;

    /**
     * @return Book
     */
    public function getBook(): Book;
}
