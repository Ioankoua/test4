<?php

namespace Mdg\Custom\Model;

use Magento\Customer\Model\CustomerFactory;


class CustomerBlock
{
    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    public function __construct(
        CustomerFactory $customerFactory
    ) {
        $this->customerFactory = $customerFactory;
    }

    /**
     * Returns array name locked users.
     *
     * @return array
     */
    public function namesCustomerBlock()
    {
        $customers = $this->customerFactory->create()->getCollection()->getData();
        $arrayNames = [];

        foreach ($customers as $item) {
            if ($item['is_active'] == 0) {
                $firstname = $item['firstname'];
                $lastname  = $item['lastname'];
                $name = $firstname.' '.$lastname;
                $arrayNames[] = $name;
            }
        }
        return $arrayNames;
    }

}
