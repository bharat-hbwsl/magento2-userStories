<?php
namespace Bharat\Mod17\Block\Layer;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Layer\Filter\Item\DataBuilder;

class RatingFilter extends Template
{
    protected $_filter;

    public function __construct(
        Template\Context $context,
        \Bharat\Mod17\Model\Layer\Filter\Rating $filter,
        array $data = []
    ) {
        $this->_filter = $filter;
        parent::__construct($context, $data);
    }

    public function getItems()
    {
        return $this->_filter->getItems();
    }

    public function getFilterUrl($item)
    {
        return $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true, $this->_filter->getRequestVar() => $item->getValue()]);
    }
}
