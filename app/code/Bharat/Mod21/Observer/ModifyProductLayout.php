<?php
namespace Bharat\Mod21\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http as Request;

class ModifyProductLayout implements ObserverInterface
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        $layout = $observer->getEvent()->getLayout();
        $affiliate = $this->request->getParam('affiliate', false);
        $affiliate=true;
        if ($affiliate) {
            $layout->getUpdate()->addHandle('catalog_product_view_affiliate');
        } else {
            $layout->getUpdate()->addHandle('catalog_product_view2');
        }
    }
}
