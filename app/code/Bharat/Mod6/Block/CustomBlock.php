<?php
namespace Bharat\Mod6\Block;

use Magento\Framework\View\Element\Template;

class CustomBlock extends Template
{
    protected function _toHtml()
    {
        return '<div>This is custom HTML content from _toHtml method</div>';
    }

    protected function _afterToHtml($html)
    {
        return $html . '<div>This is additional content added by _afterToHtml</div>';
    }
}
