<?php

namespace TestTask\InputLoader;

class LoaderFactory
{
    protected const TYPE_XML = 'xml';

    /**
     * @var array|string[]
     */
    protected static array $map = [
        self::TYPE_XML => XmlInputLoader::class,
    ];

    /**
     * @param string $type
     * @param string $inputFile
     * @return InputLoaderInterface
     */
    public static function getLoader(string $type, string $inputFile): InputLoaderInterface
    {
        return new self::$map[$type]($inputFile);
    }
}
