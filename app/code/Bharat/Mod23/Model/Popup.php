<?php
namespace Bharat\Mod22\Model;

use Magento\Framework\Model\AbstractModel;

class Popup extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Bharat\Mod22\Model\ResourceModel\Popup');
    }
}
