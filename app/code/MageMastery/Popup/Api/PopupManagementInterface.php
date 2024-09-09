<?php
declare (strict_types=1);
namespace MageMastery\Popup\Api;

use MageMastery\Popup\Api\Data\PopupInterface;

interface PopupManagementInterface
{

    public function getApplicablePopup():PopupInterface;

}
