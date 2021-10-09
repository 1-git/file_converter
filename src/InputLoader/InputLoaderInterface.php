<?php

namespace TestTask\InputLoader;

use Generator;
use TestTask\Generator\Additional\SilencesInterval;

interface InputLoaderInterface
{
    /**
     * @return Generator|SilencesInterval[]
     */
    public function getSilences(): Generator;
}
