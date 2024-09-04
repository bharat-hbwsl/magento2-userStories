<?php
namespace Bharat\Mod9\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\View\Result\PageFactory;

class Display extends Action
{
    protected $scopeConfig;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        PageFactory $resultPageFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $enable = $this->scopeConfig->getValue('general/mod9/enable', ScopeInterface::SCOPE_STORE);
        $textToDisplay = $this->scopeConfig->getValue('general/mod9/text_to_display', ScopeInterface::SCOPE_STORE);
    
        if ($enable) {
            $resultPage = $this->resultPageFactory->create();
            $block = $resultPage->getLayout()->getBlock('mod9_text');
            
            if ($block) {
                $block->setText($textToDisplay);
            }
            
            return $resultPage;
        } else {
            return $this->_redirect('/');
        }
    }    
}