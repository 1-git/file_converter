<?php

namespace TestTask\OutputSaver;

use TestTask\Generator\Additional\BookSegment;

interface OutputSaverInterface
{
    /**
     * @param BookSegment[] $segments
     */
    public function saveContent(array $segments): void;
}
