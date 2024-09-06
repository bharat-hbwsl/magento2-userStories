<?php
namespace Bharat\Mod18\Plugin;

use Psr\Log\LoggerInterface;

class ProductPricePlugin
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $this->logger->info("Original Price: " . $result);
        return $result + 1.79;
    }

    public function afterGetFinalPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $this->logger->info("Final Price: " . $result);
        return $result + 1.79;
    }
}
