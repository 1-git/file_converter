<?php

namespace TestTask\Generator\Structure;

class Chapter implements StartedAtInterface, FinishedAtInterface
{
    use StartedAtPropertyTrait;
    use FinishedAtPropertyTrait;

    /**
     * @var Part[]
     */
    protected array $parts = [];

    /**
     * @param Part $part
     * @return $this
     */
    public function addPart(Part $part): self
    {
        $this->parts[] = $part;
        return $this;
    }

    /**
     * @return Part[]
     */
    public function getParts(): array
    {
        return $this->parts;
    }
}
