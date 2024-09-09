<?php

namespace Bharat\Mod22\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Popup extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_popup';
        $this->_blockGroup = 'Bharat_Mod22';
        $this->_headerText = __('Manage Pop-ups');
        $this->_addButtonLabel = __('Add New Popup');
        parent::_construct();
    }
}
