<?php

namespace TestTask\Generator\Additional;

class BookSegment
{
    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string
     */
    protected string $offset;

    /**
     * @param string $title
     * @param string $offset
     */
    public function __construct(string $title, string $offset)
    {
        $this->title = $title;
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getOffset(): string
    {
        return $this->offset;
    }
}
