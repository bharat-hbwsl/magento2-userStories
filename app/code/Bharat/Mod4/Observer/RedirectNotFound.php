<?php
namespace Bharat\Mod4\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

class RedirectNotFound implements ObserverInterface
{
    protected $redirect;
    protected $actionFlag;
    protected $request;
    protected $response;

    public function __construct(
        RedirectInterface $redirect,
        ActionFlag $actionFlag,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $this->redirect = $redirect;
        $this->actionFlag = $actionFlag;
        $this->request = $request;
        $this->response = $response;
    }

    public function execute(Observer $observer)
    {
        $statuscode = $this->response->getStatusCode();

        if ($statuscode == 404) {
            $this->actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
            $this->redirect->redirect($this->response, '/contact');
        }
    }
}
