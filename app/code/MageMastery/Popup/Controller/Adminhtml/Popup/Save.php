<?php
declare(strict_types=1);
namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\Data\PopupInterface;
use MageMastery\Popup\Api\Data\PopupInterfaceFactory;
use MageMastery\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{

    public function __construct(
        Context $context,
        private DataPersistorInterface $dataPersistor,
        private PopupInterfaceFactory $popupFactory,
        private PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
    }

    public function execute():ResultInterface
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = PopupInterface::STATUS_ENABLED;
            }
            if (empty($data['popup_id'])) {
                $data['popup_id'] = null;
            }

            $model = $this->popupFactory->create();

            $id =(int) $this->getRequest()->getParam('popup_id');
            if ($id) {
                try {
                    $model = $this->popupRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This popup no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);
            $this->popupRepository->save($model);
            $this->messageManager->addSuccessMessage(__('You saved the popup.'));
            $this->dataPersistor->clear('magemastery_popup_popup');
            return $resultRedirect->setPath('*/*/');
            // try {
            //     $this->popupRepository->save($model);
            //     $this->messageManager->addSuccessMessage(__('You saved the popup.'));
            //     $this->dataPersistor->clear('magemastery_popup');
            //     return $resultRedirect->setPath('*/*/');
            // } catch (LocalizedException $e) {
            //     $this->messageManager->addErrorMessage($e->getMessage());
            // } catch (\Exception $e) {
            //     $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the popup.'));
            // }

            $this->dataPersistor->set('magemastery_popup_popup', $data);
            return $resultRedirect->setPath('*/*/edit', ['popup_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
