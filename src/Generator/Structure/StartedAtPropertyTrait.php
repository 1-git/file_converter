<?php

namespace TestTask\Generator\Structure;

trait StartedAtPropertyTrait
{
    /**
     * @var int
     */
    protected int $startedAt;

    /**
     * @param int $startedAt
     * @return $this
     */
    public function setStartedAt(int $startedAt): self
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartedAt(): int
    {
        return $this->startedAt;
    }
}
