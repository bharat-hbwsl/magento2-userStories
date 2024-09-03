<?php
namespace Bharat\Mod4\Controller;

use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;

class Router implements RouterInterface
{
    protected $actionFactory;

    public function __construct(
        ActionFactory $actionFactory
    ) {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        if (preg_match('#^([A-Z][a-z][0-9]+)([A-Z][a-z]+)([A-Z][a-z]+)$#', $identifier, $matches)) {
            $module = strtolower($matches[1]);
            $controller = strtolower($matches[2]);
            $action = strtolower($matches[3]);

            $request->setModuleName($module)
                    ->setControllerName($controller)
                    ->setActionName($action);

            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

        return null;
    }
}
