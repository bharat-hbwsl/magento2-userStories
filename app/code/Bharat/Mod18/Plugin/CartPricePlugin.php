<?php
namespace Bharat\Mod18\Plugin;

class CartPricePlugin
{
    public function afterGetPrice(\Magento\Quote\Model\Quote\Item $subject, $result)
    {
        return $result + 1.79;
    }

    public function afterGetBasePrice(\Magento\Quote\Model\Quote\Item $subject, $result)
    {
        return $result + 1.79;
    }
}
