<?php
namespace Bharat\Mod21\Plugin;

use Magento\Framework\View\Layout;
use Magento\Framework\App\Request\Http;

class AffiliatePlugin
{
    protected $request;

    public function __construct(Http $request)
    {
        $this->request = $request;
    }

    public function beforeGenerateElements(Layout $subject)
    {
        // Check if 'affiliate=true' is present in the URL
        $affiliate = $this->request->getParam('affiliate');

        if (!$affiliate) {
            // Remove reviews.tab block if 'affiliate' is not true
            $subject->unsetElement('reviews.tab');
        }
    }
}
