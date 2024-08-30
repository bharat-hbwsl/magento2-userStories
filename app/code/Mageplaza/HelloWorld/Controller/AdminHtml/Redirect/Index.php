<?php
namespace Mageplaza\HelloWorld\Controller\Adminhtml\Redirect;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends Action
{
    protected $rdf;

    public function __construct(Action\Context $context, RedirectFactory $rdf)
    {
        $this->rdf = $rdf;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->rdf->create();
        $resultRedirect->setUrl('http://bharat.magentotest.com:8081/helloworld/index/display');
        return $resultRedirect;
    }
}
