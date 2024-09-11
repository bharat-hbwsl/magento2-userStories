<?php

namespace Bharat\Mod22\Block\Adminhtml\Popup;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Helper\Data as BackendHelper;
use Bharat\Mod22\Model\ResourceModel\Popup\CollectionFactory as PopupCollectionFactory;

class Grid extends Extended
{
    protected $popupCollectionFactory;

    public function __construct(
        Context $context,
        BackendHelper $backendHelper,
        PopupCollectionFactory $popupCollectionFactory,
        array $data = []
    ) {
        $this->popupCollectionFactory = $popupCollectionFactory;
        parent::__construct($context, $backendHelper, $data);
        $this->setId('popupGrid');
        $this->setDefaultSort('popup_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = $this->popupCollectionFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'popup_id',
            [
                'header' => __('ID'),
                'index' => 'popup_id',
                'type' => 'number',
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Popup Title'),
                'index' => 'title',
                'type' => 'text',
            ]
        );

        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => ['0' => 'Disabled', '1' => 'Enabled'],
            ]
        );

        $this->addColumn(
            'created_at',
            [
                'header' => __('Created At'),
                'index' => 'created_at',
                'type' => 'datetime',
            ]
        );

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
