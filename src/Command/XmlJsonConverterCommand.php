<?php

namespace TestTask\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TestTask\Generator\BookGenerator;
use TestTask\Generator\MainSegmentCreator;
use TestTask\Generator\SegmentGenerator;
use TestTask\InputLoader\LoaderFactory;
use TestTask\OutputSaver\SaverFactory;

class XmlJsonConverterCommand extends Command
{
    const INPUT_FILE_TYPE = 'xml';

    const OUTPUT_FILE_TYPE = 'json';

    /**
     * @inheritDoc
     */
    protected static $defaultName = 'app:convert';

    /**
     * @inheritDoc
     */
    protected static $defaultDescription = 'Converting a file with silence to a file with segments';

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->setDefinition([
                new InputArgument('input-file', InputArgument::REQUIRED, 'InputLoader xml file with silences (from the current folder)'),
                new InputArgument('output-file', InputArgument::OPTIONAL, 'OutputSaver json file with silences (it will be created in the current folder)', 'output.json'),
                new InputOption('chapter-silence-ms', null, InputOption::VALUE_REQUIRED, 'Silence interval for the chapter in milliseconds', 3000),
                new InputOption('part-silence-ms', null, InputOption::VALUE_REQUIRED, 'Silence interval for the chapter part in milliseconds', 1000),
                new InputOption('silence-duration-min', null, InputOption::VALUE_REQUIRED, 'Maximum segment length in min', 10),
            ])
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> converting a file with silence to a file with segments:

  <info>php %command.full_name% input-file.xml output.json</info>

or

  <info>php %command.full_name% input-file.xml output.json --chapter-silence-ms=1000 --part-silence-ms=500 --silence-duration-min=5</info>

EOF
            );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFile = getcwd() . '/files/input/' . $input->getArgument('input-file');
        $outputFile = getcwd() . '/files/output/' . $input->getArgument('output-file');

        $inputLoader = LoaderFactory::getLoader(self::INPUT_FILE_TYPE, $inputFile);
        $outputSaver = SaverFactory::getSaver(self::OUTPUT_FILE_TYPE, $outputFile);
        $bookGenerator = new BookGenerator($input->getOption('chapter-silence-ms'), $input->getOption('part-silence-ms'));
        $segmentGenerator = new SegmentGenerator($input->getOption('silence-duration-min'));

        (new MainSegmentCreator($inputLoader, $outputSaver, $bookGenerator, $segmentGenerator))->createSegments();

        $output->writeln('File was saved');

        return Command::SUCCESS;
    }
}
