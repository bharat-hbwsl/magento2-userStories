<?php
namespace Bharat\Mod9\Block;

use Magento\Framework\View\Element\Template;

class Text extends Template
{
    public function setText($text)
    {
        $this->setData('text', $text);
    }

    public function getText()
    {
        return $this->getData('text');
    }
}
