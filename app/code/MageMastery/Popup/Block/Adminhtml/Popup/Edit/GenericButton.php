<?php
declare(strict_types=1);
namespace MageMastery\Popup\Block\Adminhtml\Popup\Edit;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

class GenericButton
{
    public function __construct(
        private UrlInterface $url,
        private RequestInterface $request
    ) {
    }

    /**
     * Return CMS block ID
     *
     * @return int|null
     */
    public function getPopupId():int
    {
        return (int)$this->request->getParam('popup_id', 0);
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = []):string
    {
        return $this->url->getUrl($route, $params);
    }
}
