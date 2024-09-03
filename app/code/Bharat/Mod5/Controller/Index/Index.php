<?php
namespace Bharat\Mod5\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends Action
{
    protected $productRepository;
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->productRepository = $productRepository;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $productId = 2;
        $product = $this->productRepository->getById($productId);
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($product->getProductUrl());
        return $resultRedirect;
    }
}
