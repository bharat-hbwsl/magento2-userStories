<?php

namespace Bharat\Mod20\Plugin\Product;

class View
{
    public function afterGetAddToCartUrl(
        \Magento\Catalog\Block\Product\View $subject,
        $result
    ) {
        $product = $subject->getProduct();
 
        if ($product->getQty() <= 1) {
            echo "This stock is less";
        }

        return $result;
    }
}