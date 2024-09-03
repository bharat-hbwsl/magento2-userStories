<?php
namespace Bharat\Mod5\Plugin;

class ModifyProductView
{
    public function afterToHtml(\Magento\Catalog\Block\Product\View $subject, $result)
    {
        return $result . "<p>Custom content added by Bharat_Mod5 plugin.</p>";
    }
}
