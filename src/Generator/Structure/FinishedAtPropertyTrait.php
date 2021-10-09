<?php

namespace TestTask\Generator\Structure;

trait FinishedAtPropertyTrait
{
    /**
     * @var int
     */
    protected int $finishedAt;

    /**
     * @param int $finishedAt
     * @return $this
     */
    public function setFinishedAt(int $finishedAt): self
    {
        $this->finishedAt = $finishedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getFinishedAt(): int
    {
        return $this->finishedAt;
    }
}
