<?php

namespace Mdg\Custom\Model;


use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Customer;


class CustomerRegister
{
    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var Customer
     */
    private $customers;

    public function __construct(
        DateTime $date,
        CustomerFactory $customerFactory,
        Customer $customers
    ) {
        $this->date = $date;
        $this->customerFactory = $customerFactory;
        $this->customer = $customers;
    }

    /**
     * Returns array name users which signup yesterday.
     *
     * @return array
     */
    public function yesterdaySignupNames()
    {
        $customers = $this->yesterdaySignupCustomers();

        $customerName = $this->getCustomerName($customers);

        return $customerName;
    }

    private function yesterdaySignupCustomers()
    {
        $yesterday = $this->date->gmtDate('Y.m.d', strtotime("-1 days"));

        $startDay = "$yesterday" . " " . "00:00:00";
        $endDay = "$yesterday" . " " . "23:59:59";

        $customers = $this->customerFactory->create()->getCollection()
            ->addAttributeToSelect('created_at')
            ->addAttributeToFilter("created_at", array('from' => $startDay, 'to' => $endDay))
            ->load();

        return $customers;
    }

    private function getCustomerName($customers)
    {
        $arrayNames = [];
        foreach ($customers as $item){
            $name = $item->getName();
            $arrayNames[] = $name;
        }
        return $arrayNames;
    }

}
