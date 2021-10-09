<?php

namespace TestTask\Generator\Additional;

use TestTask\DateConverter\PeriodToMilliseconds;

class SilencesInterval
{
    /**
     * @var string
     */
    protected string $from;

    /**
     * @var string
     */
    protected string $until;

    /**
     * @param string $from
     * @param string $until
     */
    public function __construct(string $from, string $until)
    {
        $this->from = (new PeriodToMilliseconds($from))->getTotalMilliseconds();
        $this->until = (new PeriodToMilliseconds($until))->getTotalMilliseconds();;
    }

    /**
     * @return string
     */
    public function getFromMs(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getUntilMs(): string
    {
        return $this->until;
    }
}
