<?php

namespace TestTask\OutputSaver;

class SaverFactory
{
    protected const TYPE_JSON = 'json';

    /**
     * @var array|string[]
     */
    protected static array $map = [
        self::TYPE_JSON => JsonOutputSaver::class,
    ];

    /**
     * @param string $type
     * @param string $outputFile
     * @return OutputSaverInterface
     */
    public static function getSaver(string $type, string $outputFile): OutputSaverInterface
    {
        return new self::$map[$type]($outputFile);
    }
}
