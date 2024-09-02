<?php
namespace Bharat\Mod3\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;

class LogProductDetails implements ObserverInterface
{
    protected $logger;
    protected $productRepository;
    protected $getProductSalableQty;

    public function __construct(
        LoggerInterface $logger,
        ProductRepositoryInterface $productRepository,
        GetProductSalableQtyInterface $getProductSalableQty
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
        $this->getProductSalableQty = $getProductSalableQty;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $productId = $product->getId();

        $product = $this->productRepository->getById($productId);

        $name = $product->getName();
        $sku = $product->getSku();
        $price = $product->getPrice();
        $quantityPerSource = $product->getExtensionAttributes()->getStockItem()->getQty();
        $salableQuantity = $this->getProductSalableQty->execute($sku, 1);

        $this->logger->info('Product Name: ' . $name);
        $this->logger->info('SKU: ' . $sku);
        $this->logger->info('Price: ' . $price);
        $this->logger->info('Quantity per Source: ' . $quantityPerSource);
        $this->logger->info('Salable Quantity: ' . $salableQuantity);
    }
}
