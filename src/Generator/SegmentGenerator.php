<?php

namespace TestTask\Generator;

use TestTask\DateConverter\MillisecondsToPeriod;
use TestTask\Generator\Additional\BookSegment;
use TestTask\Generator\Structure\Book;
use TestTask\Generator\Structure\Chapter;

class SegmentGenerator implements SegmentGeneratorInterface
{
    /**
     * @var int
     */
    protected int $silenceDurationMs;

    /**
     * @param int $silenceDurationMin
     */
    public function __construct(int $silenceDurationMin)
    {
        $this->silenceDurationMs = $silenceDurationMin * 60 * 1000;
    }

    /**
     * @inheritDoc
     */
    public function getSegments(Book $book): array
    {
        $segments = [];
        foreach ($book->getChapters() as $chapterKey => $chapter) {
            if ($this->isSplittedChapter($chapter)) {
                foreach ($chapter->getParts() as $partKey => $part) {
                    $title = sprintf('Chapter %d, part %d', $chapterKey + 1, $partKey + 1);
                    $segments[] = $this->createSegment($part->getStartedAt(), $title);
                }
            } else {
                $title = sprintf('Chapter %d', $chapterKey + 1);
                $segments[] = $this->createSegment($chapter->getStartedAt(), $title);
            }
        }

        return $segments;
    }

    /**
     * @param Chapter $chapter
     * @return int
     */
    protected function isSplittedChapter(Chapter $chapter): int
    {
        $duration = $chapter->getFinishedAt() - $chapter->getStartedAt();
        return count($chapter->getParts()) > 1 && $duration > $this->silenceDurationMs;
    }

    /**
     * @param int $offsetMs
     * @param string $title
     * @return BookSegment
     */
    protected function createSegment(int $offsetMs, string $title): BookSegment
    {
        $offsetString = (new MillisecondsToPeriod($offsetMs))->getPeriod();

        return new BookSegment($title, $offsetString);
    }
}
