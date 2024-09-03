<?php
namespace Bharat\Mod4\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\RouterListInterface;

class LogAvailableRouters implements ObserverInterface
{
    protected $logger;
    protected $routerList;

    public function __construct(
        LoggerInterface $logger,
        RouterListInterface $routerList
    ) {
        $this->logger = $logger;
        $this->routerList = $routerList;
    }

    public function execute(Observer $observer)
    {
        foreach ($this->routerList as $router) {
            $this->logger->info('Available Router: ' . get_class($router));
        }
    }
}
