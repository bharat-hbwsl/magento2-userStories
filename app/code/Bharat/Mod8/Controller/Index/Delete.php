<?php
namespace Bharat\Mod8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Bharat\Mod8\Model\EmployeeFactory;

class Delete extends Action
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
        $employeeId = $this->getRequest()->getParam('id');
        if ($employeeId) {
            try {
                $employee = $this->employeeFactory->create()->load($employeeId);
                if ($employee->getId()) {
                    $employee->delete();
                    $this->messageManager->addSuccessMessage(__('Employee deleted successfully.'));
                } else {
                    $this->messageManager->addErrorMessage(__('Employee not found.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
}
