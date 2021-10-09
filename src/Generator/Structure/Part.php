<?php

namespace TestTask\Generator\Structure;

class Part implements StartedAtInterface, FinishedAtInterface
{
    use StartedAtPropertyTrait;
    use FinishedAtPropertyTrait;
}
