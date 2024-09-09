<?php
declare (strict_types=1);
namespace MageMastery\Popup\Api;

use MageMastery\Popup\Api\Data\PopupInterface;

interface PopupRepositoryInterface
{
    public function save(PopupInterface $popup):void;

    public function delete(PopupInterface $popup):void;

    public function getById(int $popupId):PopupInterface;

}
