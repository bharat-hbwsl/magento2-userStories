<?php
namespace Bharat\Mod2\Plugin;

use Magento\Theme\Block\Html\Breadcrumbs;

class BreadcrumbPlugin
{
    public function afterGetLabel(Breadcrumbs $subject, $result)
    {
        return 'Hummingbird ' . $result;
    }
}
