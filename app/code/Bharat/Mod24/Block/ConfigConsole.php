<?php

namespace Bharat\Mod24\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class ConfigConsole extends Template
{
    public function getStoreConfigData()
    {
        return [
            'sales_email' => $this->_scopeConfig->getValue('trans_email/ident_sales/email', ScopeInterface::SCOPE_STORE),
            'payment_methods' => $this->_scopeConfig->getValue('payment', ScopeInterface::SCOPE_STORE),
        ];
    }
}
