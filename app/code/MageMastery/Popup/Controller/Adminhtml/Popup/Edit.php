<?php
declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Action
{
    public function __construct(
        Context $context,
        private PopupRepositoryInterface $popupRepository,
        private DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
    }
    public function execute(): ResultInterface
    {
        $page=$this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $popupId=(int)$this->getRequest()->getParam('popup_id');
        try {
            $popup=$this->popupRepository->getById($popupId);
            $this->dataPersistor->set('magemastery_popup_popup', $popup->getData());
            $page->setActiveMenu('MageMastery_Popup::popup');
            $page->addBreadcrumb(__('Popups'), __('Popups'));
            $page->addBreadcrumb(
                $popup->getPopupId() ? $popup->getName() : __('New Popup'),
                $popup->getPopupId() ? $popup->getName() : __('New Popup')
            );
            $page->getConfig()->getTitle()->prepend(
                $popup->getPopupId() ? $popup->getName() : __('New Popup')
            );
        } catch(NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(
                __('The popup with the given id does not exist.')
            );
        }
        return $page;
    }

}
