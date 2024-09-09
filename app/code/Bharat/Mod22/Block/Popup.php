<?php
namespace Bharat\Mod22\Block;

use Magento\Framework\View\Element\Template;
use Bharat\Mod22\Model\ResourceModel\Popup\CollectionFactory;

class Popup extends Template
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

    public function getActivePopups()
    {
        $collection = $this->collectionFactory->create();
        echo "Hello There";
        $collection->addFieldToFilter('is_active', 1);
        return $collection;
    }
}
