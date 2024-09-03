<?php
namespace Bharat\Mod4\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\UrlRewrite\Model\UrlRewriteFactory;

class InstallData implements InstallDataInterface
{
    protected $urlRewriteFactory;

    public function __construct(
        UrlRewriteFactory $urlRewriteFactory
    ) {
        $this->urlRewriteFactory = $urlRewriteFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $urlRewriteModel = $this->urlRewriteFactory->create();
        $urlRewriteModel->setStoreId(1) // Store ID
            ->setIsSystem(0)
            ->setIdPath('contactuspage')
            ->setRequestPath('contactuspage.html')
            ->setTargetPath('contact')
            ->save();
    }
}
