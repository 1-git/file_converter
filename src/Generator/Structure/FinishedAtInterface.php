<?php

namespace TestTask\Generator\Structure;

interface FinishedAtInterface
{
    /**
     * @param int $finishedAt
     * @return $this
     */
    public function setFinishedAt(int $finishedAt): self;

    /**
     * @return int
     */
    public function getFinishedAt(): int;
}
