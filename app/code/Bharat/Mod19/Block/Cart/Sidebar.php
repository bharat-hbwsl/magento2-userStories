<?php

namespace Bharat\Mod19\Plugin\Cart;

class Sidebar
{
    protected $productRepository;
    protected $collectionFactory;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
    ) {
        $this->productRepository = $productRepository;
        $this->collectionFactory = $collectionFactory;
    }

    public function afterGetItems(
        \Magento\Checkout\Block\Cart\Sidebar $subject,
        $result
    ) {
        $items = $subject->getItems();
        $crossSellProducts = [];
        foreach ($items as $item) {
            $productId = $item->getProductId();
            $product = $this->productRepository->getById($productId);
            $crossSellCollection = $this->collectionFactory->create()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('type_id', 'cross_sell')
                ->setPageSize(2); 
            foreach ($crossSellCollection as $crossSellProduct) {
                $crossSellProducts[] = $crossSellProduct;
            }
        }
        $subject->setData('cross_sell_products', $crossSellProducts);
        return $result;
    }
}
