<?php

declare(strict_types=1);

namespace MageMastery\Popup\Ui\Popup;

use MageMastery\Popup\Model\ResourceModel\Popup\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{

    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    private array $loadedData=[];

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $popup) {
            $this->loadedData[$popup->getId()] = $popup->getData();
        }

        $data = $this->dataPersistor->get('magemastery_popup_popup');
        if (!empty($data)) {
            $popup = $this->collection->getNewEmptyItem();
            $popup->setData($data);
            $this->loadedData[$popup->getId()] = $popup->getData();
            $this->dataPersistor->clear('magemastery_popup_popup');
        }

        return $this->loadedData;
    }
}
