<?php

namespace Bharat\Mod8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Bharat\Mod8\Model\EmployeeFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $employeeFactory;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory,
        PageFactory $resultPageFactory
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
