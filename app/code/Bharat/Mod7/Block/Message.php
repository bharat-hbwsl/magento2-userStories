<?php
namespace Bharat\Mod7\Block;

use Magento\Framework\View\Element\Template;

class Message extends Template
{
    protected function _toHtml()
    {
        return '<p>This is displayed by Bharat on all pages</p>';
    }
    protected function _afterToHtml($html)
    {
        return $html . '<p>Additional message from _afterToHtml() given by Guruji !!</p>';
    }
    public function HelloWorld(){
        return "<p>Hello World</p>";
    }
}