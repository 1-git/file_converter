<?php

namespace TestTask\DateConverter;

class MillisecondsToPeriod
{
    /**
     * @var int
     */
    protected int $hours;

    /**
     * @var int
     */
    protected int $minutes;

    /**
     * @var int
     */
    protected int $seconds;

    /**
     * @var int
     */
    protected int $milliseconds;

    /**
     * @param int $milliseconds
     */
    public function __construct(int $milliseconds)
    {
        $this->milliseconds = $milliseconds % 1000;
        $this->seconds = $milliseconds / 1000 % 60;
        $this->minutes = ($milliseconds / (1000 * 60)) % 60;
        $this->hours = $milliseconds / (1000 * 60 * 60);
    }

    /**
     * @return string
     */
    public function getPeriod(): string
    {
        $hours = $this->hours ? sprintf('%dH', $this->hours) : '';
        $minutes = $this->minutes ? sprintf('%dM', $this->minutes) : '';
        if ($this->milliseconds) {
            $milliseconds = trim($this->milliseconds, 0);
            if ($this->seconds) {
                $seconds = sprintf('%d.%dS', $this->seconds, $milliseconds);
            } else {
                $seconds = sprintf('%d.%dS', 0, $milliseconds);
            }
        } else {
            $seconds = sprintf('%dS', $this->seconds);
        }

        return 'PT' . $hours . $minutes . $seconds;
    }
}
