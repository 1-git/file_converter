<?php

namespace TestTask\DateConverter;

class PeriodToMilliseconds
{
    /**
     * @var int
     */
    protected int $hours = 0;

    /**
     * @var int
     */
    protected int $minutes = 0;

    /**
     * @var int
     */
    protected int $milliseconds = 0;

    /**
     * @param string $period
     */
    public function __construct(string $period)
    {
        preg_match('#PT([\d]*H)?([\d]*M)?([\d.]*S)?#', $period, $matches);

        if ($matches) {
            $this->hours = (int)rtrim($matches[1], 'H');
            $this->minutes = (int)rtrim($matches[2], 'M');
            $this->milliseconds = (int)(rtrim($matches[3], 'S') * 1000);
        }
    }

    /**
     * @return int
     */
    public function getTotalMilliseconds(): int
    {
        return
            $this->milliseconds +
            $this->minutes * 1000 * 60 +
            $this->hours * 1000 * 60 * 60;
    }
}
