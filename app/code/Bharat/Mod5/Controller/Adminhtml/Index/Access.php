<?php
namespace Bharat\Mod5\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Access extends Action
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $access = $this->getRequest()->getParam('access', false);
        if ($access === 'True') {
            echo "Admin Access Granted!";
        } else {
            echo "Access Denied!";
        }
        exit;
    }
}
