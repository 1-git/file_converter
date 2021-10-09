<?php

namespace TestTask\Generator;

use Exception;
use TestTask\Generator\Additional\SilencesInterval;
use TestTask\Generator\Structure\Book;
use TestTask\Generator\Structure\Chapter;
use TestTask\Generator\Structure\Part;

class BookGenerator implements BookGeneratorInterface
{
    /**
     * @var int
     */
    protected int $chapterSilenceMs;

    /**
     * @var int
     */
    protected int $partSilenceMs;

    /**
     * @var Book|null
     */
    protected ?Book $book = null;

    /**
     * @var Chapter|null
     */
    protected ?Chapter $chapterTemp = null;

    /**
     * @var Part|null
     */
    protected ?Part $partTemp = null;

    /**
     * @var SilencesInterval|null
     */
    protected ?SilencesInterval $previousSilence = null;

    /**
     * @param int $chapterSilenceMs
     * @param int $partSilenceMs
     * @throws Exception
     */
    public function __construct(int $chapterSilenceMs, int $partSilenceMs)
    {
        if ($chapterSilenceMs < $partSilenceMs) {
            throw new Exception('Silence duration which can be used to split a long chapter always shorter than the silence duration used to split chapters');
        }

        $this->chapterSilenceMs = $chapterSilenceMs;
        $this->partSilenceMs = $partSilenceMs;
    }

    /**
     * @inheritDoc
     */
    public function getBook(): Book
    {
        return $this->book;
    }

    /**
     * @inheritDoc
     */
    public function addSilence(SilencesInterval $silence): void
    {
        $this->createElements();

        $startedAtMs = $silence->getFromMs();
        $finishedAtMs = $silence->getUntilMs();

        $period = $finishedAtMs - $startedAtMs;
        if ($period > $this->chapterSilenceMs) {
            $this->partTemp->setFinishedAt($startedAtMs);
            $this->chapterTemp->addPart($this->partTemp);
            $this->partTemp = null;

            $this->chapterTemp->setFinishedAt($startedAtMs);
            $this->book->addChapter($this->chapterTemp);
            $this->chapterTemp = null;
        } elseif ($period > $this->partSilenceMs) {
            $this->partTemp->setFinishedAt($startedAtMs);
            $this->chapterTemp->addPart($this->partTemp);
            $this->partTemp = null;
        }

        $this->previousSilence = $silence;
    }

    protected function createElements(): void
    {
        if (!$this->book) {
            $this->book = (new Book())->setStartedAt(0);
        }
        $previousSilenceStarted = $this->previousSilence ? $this->previousSilence->getUntilMs() : 0;
        if (!$this->chapterTemp) {
            $this->chapterTemp = new Chapter();
            $this->chapterTemp->setStartedAt($previousSilenceStarted);
        }
        if (!$this->partTemp) {
            $this->partTemp = new Part();
            $this->partTemp->setStartedAt($previousSilenceStarted);
        }
    }
}
