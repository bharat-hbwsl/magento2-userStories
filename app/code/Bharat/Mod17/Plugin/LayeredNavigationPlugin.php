<?php
namespace Bharat\Mod17\Plugin;

use Magento\Catalog\Model\Layer;
use Magento\Catalog\Model\Layer\FilterList;

class LayeredNavigationPlugin
{
    protected $filterList;

    public function __construct(FilterList $filterList)
    {
        $this->filterList = $filterList;
    }

    public function afterGetFilters(Layer $subject, $result)
    {
        $ratingFilter = $this->filterList->getFilter(\Bharat\Mod17\Model\Layer\Filter\Rating::class);
        $result[] = $ratingFilter;
        return $result;
    }
}
