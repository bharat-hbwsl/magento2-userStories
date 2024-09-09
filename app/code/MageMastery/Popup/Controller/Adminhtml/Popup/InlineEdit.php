<?php
declare(strict_types=1);
namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use MageMastery\Popup\Model\ResourceModel\Popup\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class InlineEdit extends Action
{
    public function __construct(
        Context $context,
        private CollectionFactory $collectionFactory,
        private PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
    }

    public function execute():ResultInterface
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $items=$this->getRequest()->getParam('items');
        $message=[];
        $error=false;

        if(!count($items)) {
            $message[]=__('Please correct the data sent');
            $error = true;
        } else {

            foreach(array_keys($items) as $popupId) {
                try {
                    $popup=$this->popupRepository->getById((int)$popupId);
                    $popup->setData(array_merge($popup->getData(), $items[$popupId]));
                    $this->popupRepository->save($popup);
                } catch(\Throwable $exception) {
                    $message[]='[Popup ID:' . $popupId . ']' . $exception->getMessage();
                    $error=true;
                }
            }
        }

        return $result->setData(
            [
                'message' => $message,
                'error'   => $error
            ]
        );

    }

}
