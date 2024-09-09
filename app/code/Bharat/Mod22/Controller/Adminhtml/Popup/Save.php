<?php

namespace Bharat\Mod22\Controller\Adminhtml\Popup;

use Magento\Backend\App\Action;
use Bharat\Mod22\Model\PopupFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    protected $popupFactory;
    protected $dataPersistor;

    public function __construct(
        Action\Context $context,
        PopupFactory $popupFactory,
        DataPersistorInterface $dataPersistor
    ) {
        $this->popupFactory = $popupFactory;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            return $this->_redirect('mod22/popup/index');
        }

        try {
            $popup = $this->popupFactory->create();

            if (isset($data['popup_id'])) {
                $popup->load($data['popup_id']);
            }

            $popup->setData($data);
            $popup->save();

            $this->messageManager->addSuccessMessage(__('Popup has been saved.'));
            $this->dataPersistor->clear('mod22_popup');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while saving the popup.'));
        }

        return $this->_redirect('mod22/popup/index');
    }
}
