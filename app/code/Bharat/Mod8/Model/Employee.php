<?php
namespace Bharat\Mod8\Model;

use Magento\Framework\Model\AbstractModel;
use Bharat\Mod8\Model\ResourceModel\Employee as EmployeeResource;
use Magento\Framework\Exception\LocalizedException;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(EmployeeResource::class);
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        // Validate employee_id format
        if (!preg_match('/^EMP\d+$/', $this->getEmployeeId())) {
            throw new LocalizedException(__('Invalid Employee ID format.'));
        }

        // Validate first_name and last_name
        if (strlen($this->getFirstName()) > 30 || !preg_match('/^[a-zA-Z]+$/', $this->getFirstName())) {
            throw new LocalizedException(__('First Name must be less than 30 characters and contain only letters.'));
        }
        if (strlen($this->getLastName()) > 30 || !preg_match('/^[a-zA-Z]+$/', $this->getLastName())) {
            throw new LocalizedException(__('Last Name must be less than 30 characters and contain only letters.'));
        }

        // Validate email_id
        if (!filter_var($this->getEmailId(), FILTER_VALIDATE_EMAIL)) {
            throw new LocalizedException(__('Invalid email address.'));
        }

        // Validate address
        if (strlen($this->getAddress()) < 8) {
            throw new LocalizedException(__('Address must be greater than 30 characters.'));
        }

        // Validate phone_number
        if (!preg_match('/^\d{10}$/', $this->getPhoneNumber())) {
            throw new LocalizedException(__('Phone Number must be exactly 10 digits.'));
        }

        return $this;
    }
}
