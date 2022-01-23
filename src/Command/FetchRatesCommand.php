<?php

namespace App\Command;

use App\Model\RateHistoryFetcher\RateHistoryRecordFetchService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchRatesCommand extends Command
{
    protected static $defaultName = 'app:fetch-rates';
    private RateHistoryRecordFetchService $service;
    private ManagerRegistry $doctrine;

    public function __construct(RateHistoryRecordFetchService $service, ManagerRegistry $doctrine)
    {
        $this->service = $service;
        $this->doctrine = $doctrine;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp('This command fetches last exchange rates and stores them locally.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->service->fetch();
            $this->doctrine->getManager()->flush();
            $output->writeln('Rates fetched successfully.');

            return Command::SUCCESS;
        } catch (\Throwable $throwable) {
            $output->writeln('Cannot fetch rates, error: ' . $throwable->getMessage());

            return Command::FAILURE;
        }
    }
}
