<?php
namespace Bharat\Mod2\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Pricing\Helper\Data as PricingHelper;

class ProductPlugin
{
    protected $pricingHelper;

    public function __construct(PricingHelper $pricingHelper)
    {
        $this->pricingHelper = $pricingHelper;
    }

    public function afterGetName(ProductInterface $subject, $result)
    {
        $price = $subject->getPrice();

        if ($price < 20) {
            $result .= " WholeSale !!";
        } elseif ($price >= 20 && $price < 50) {
            $discountedPrice = $price * 0.85;
            $formattedDP = $this->pricingHelper->currency($discountedPrice, true, false);
            $result .= " Super Sale!! (Discounted Price: " . $formattedDP . ")";
        } elseif ($price >= 50) {
            $result .= " Premium !!";
        }

        return $result;
    }
}
