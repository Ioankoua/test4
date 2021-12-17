<?php

namespace Mdg\Custom\Model;

use Magento\Customer\Model\ResourceModel\Online\Grid\CollectionFactory;


class CustomerOnline
{

    /**
     * @var CollectionFactory
     */
    private $onlineCollFactory;

    public function __construct(
        CollectionFactory $onlineCollFactory
    ) {
        $this->onlineCollFactory = $onlineCollFactory;
    }

    /**
     * Returns array name online users.
     *
     * @return array
     */
    public function namesCustomerOnline()
    {
        $customers = $this->onlineCollFactory->create()->getData();

        $arrayNames = [];
        foreach ($customers as $item){
            $firstname = $item['firstname'];
            $lastname  = $item['lastname'];
            $name = $firstname.' '.$lastname;
            $arrayNames[] = $name;
        }
        return $arrayNames;
    }

}
