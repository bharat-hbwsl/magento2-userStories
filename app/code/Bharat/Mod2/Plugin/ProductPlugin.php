<?php
namespace Bharat\Mod2\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;

class ProductPlugin
{
    public function afterGetName(ProductInterface $subject, $result)
    {
        $price = $subject->getPrice();
        if ($price < 70) {
            $result .= " On Sale!";
        }
        return $result;
    }
}
