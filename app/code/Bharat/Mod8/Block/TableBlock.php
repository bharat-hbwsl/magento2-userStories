<?php
namespace Bharat\Mod8\Block;

use Magento\Framework\View\Element\Template;
use Bharat\Mod8\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\App\Request\Http;

class TableBlock extends Template
{
    protected $collectionFactory;
    protected $request;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Http $request,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getEmployees()
    {
        $collection = $this->collectionFactory->create();
        $sortOrder = $this->request->getParam('sort', 'asc');
        $collection->setOrder('employee_id', $sortOrder);
        return $collection->getItems();
    }

    public function getDeleteUrl($employeeId)
    {
        return $this->getUrl('mod8/index/delete', ['id' => $employeeId]);
    }
}
