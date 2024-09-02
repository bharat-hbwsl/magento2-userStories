<?php
namespace Bharat\Mod3\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class LogPageHtml implements ObserverInterface
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $response = $observer->getResponse();

        if ($response) {
            $html = $response->getBody()->getContents();
            $this->logger->info('Page HTML: ' . $html);
        } else {
            $this->logger->error('Failed to retrieve response body; response is null.');
        }
    }
}
