<?php
namespace Bharat\Mod15\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderPlacement extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_order_placement', 'id');
    }
}
