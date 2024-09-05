<?php
namespace Bharat\Mod14\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Model\ProductRepository;

class LowStockObserver implements ObserverInterface
{
    protected $logger;
    protected $threshold = 10;
    protected $productRepository;

    public function __construct(
        LoggerInterface $logger,
        ProductRepository $productRepository
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
    }

    public function execute(Observer $observer)
    {
        $stockItem = $observer->getEvent()->getItem();
        $qty = $stockItem->getQty();
        $productId = $stockItem->getProductId();

        if ($productId && $qty < $this->threshold) {
            try {
                $product = $this->productRepository->getById($productId);
                $this->logger->info("Product: " . $product->getName() . " is low on stock. Quantity: " . $qty);
            } catch (\Exception $e) {
                $this->logger->error('Error loading product: ' . $e->getMessage());
            }
        }
    }
}
