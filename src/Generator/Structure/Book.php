<?php

namespace TestTask\Generator\Structure;

class Book
{
    use StartedAtPropertyTrait;
    use FinishedAtPropertyTrait;

    /**
     * @var Chapter[]
     */
    protected array $chapters = [];

    /**
     * @param Chapter $chapter
     * @return $this
     */
    public function addChapter(Chapter $chapter): self
    {
        $this->chapters[] = $chapter;
        return $this;
    }

    /**
     * @return Chapter[]
     */
    public function getChapters(): array
    {
        return $this->chapters;
    }
}
