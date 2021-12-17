<?php

namespace Mdg\Custom\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Mdg\Custom\Model\CustomerBlock;


class CustomerBlocked extends Command
{
    /**
     * @var CustomerBlock
     */
    private $customerNames;

    public function __construct(
        CustomerBlock $customerNames
    ) {
        $this->customerNames = $customerNames;

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('customer:block');
        $this->setDescription('Displays firstname and lastname of customers who blocked');

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
        $Names = $this->customerNames->namesCustomerBlock();

        if (empty($Names)) {
            $output->writeln('<error>An error there is no data</error>');
            $output->writeln('<comment>No users found who blocked</comment>');
        } else {
            foreach ($Names as $name) {
                $output->writeln('<info>Blocked users `' . $name . '`</info>');
            }
        }
    }

}
