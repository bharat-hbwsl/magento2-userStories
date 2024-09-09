<?php
declare(strict_types=1);
namespace MageMastery\Popup\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Popup extends AbstractDb
{
    private $dateTime;

    private const TABLE_NAME='magemastery_popup';
    private const FIELD_NAME='popup_id';
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        DateTime $dateTime,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->dateTime = $dateTime;
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::FIELD_NAME);
    }

    protected function _beforeSave(AbstractModel $object)
    {
        $currentTime = $this->dateTime->gmtDate();
        $object->setData('updated_at', $currentTime);
        return parent::_beforeSave($object);
    }
}
