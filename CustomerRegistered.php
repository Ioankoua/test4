<?php

namespace Mdg\Custom\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Mdg\Custom\Model\CustomerRegister;


class CustomerRegistered  extends Command
{
    /**
     * @var CustomerRegister
     */
    private $customerNames;

    public function __construct(
        CustomerRegister $customerNames
    ) {
        $this->customerNames = $customerNames;

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('customer:registered');
        $this->setDescription('Displays firstname and lastname of customers who registered yesterday');

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $Names = $this->customerNames->yesterdaySignupNames();

        if (empty($Names)) {
            $output->writeln('<error>An error there is no data</error>');
            $output->writeln('<comment>No users found who registered yesterday</comment>');
        } else {
            foreach ($Names as $name) {
                $output->writeln('<info>Signup yesterday `' . $name . '`</info>');
            }
        }
    }

}


