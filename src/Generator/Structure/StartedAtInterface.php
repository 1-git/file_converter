<?php

namespace TestTask\Generator\Structure;

interface StartedAtInterface
{
    /**
     * @param int $startedAt
     * @return $this
     */
    public function setStartedAt(int $startedAt): self;

    /**
     * @return int
     */
    public function getStartedAt(): int;
}
