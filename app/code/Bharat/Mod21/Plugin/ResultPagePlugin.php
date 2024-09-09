<?php
namespace Bharat\Mod21\Plugin;

use Magento\Framework\View\Result\Page as ResultPage;
use Magento\Framework\App\Request\Http;

class ResultPagePlugin
{
    protected $request;

    public function __construct(Http $request)
    {
        $this->request = $request;
    }

    public function beforeSetLayout(ResultPage $subject)
    {
        $affiliate = $this->request->getParam('affiliate');
        $affiliate = true;
        if ($affiliate) {
            $subject->getConfig()->setPageLayout('catalog_product_view_affiliate');
        } else {
            $subject->getConfig()->setPageLayout('catalog_product_view');
        }
    }
}
