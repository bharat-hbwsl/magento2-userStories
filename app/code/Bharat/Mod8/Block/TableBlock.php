<?php

namespace Bharat\Mod8\Block;

use Magento\Framework\View\Element\Template;
use Bharat\Mod8\Model\ResourceModel\Employee\CollectionFactory;

class TableBlock extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getEmployees()
    {
        $collection = $this->collectionFactory->create();
        return $collection->getItems();
    }
}
