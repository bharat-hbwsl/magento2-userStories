<?php

namespace Bharat\Mod8\Model;

use Magento\Framework\Model\AbstractModel;
use Bharat\Mod8\Model\ResourceModel\Employee as EmployeeResource;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(EmployeeResource::class);
    }
}
