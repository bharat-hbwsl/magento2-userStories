<?php

namespace Bharat\Mod8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Bharat\Mod8\Model\EmployeeFactory;

class Save extends Action
{
    protected $employeeFactory;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory
    ) {
        $this->employeeFactory = $employeeFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $employee = $this->employeeFactory->create();
        $employee->setData($data);
        $employee->save();
        $this->_redirect('*/*/');
    }
}