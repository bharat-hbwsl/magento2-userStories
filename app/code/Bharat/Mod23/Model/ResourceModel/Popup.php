<?php
namespace Bharat\Mod22\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Popup extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('bharat_mod22_popup', 'popup_id');
    }
}
