<?php
declare (strict_types=1);

namespace MageMastery\Popup\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class PopupActions extends Column
{
    /** Url path */
    private const URL_PATH_EDIT = 'magemastery_popup/popup/edit';
    private const URL_PATH_DELETE = 'magemastery_popup/popup/delete';

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * @var string
     */
    private string $editUrl;

    /**
     * @var Escaper
     */
    private Escaper $escaper;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Escaper $escaper,
        array $components = [],
        array $data = [],
        string $editUrl = self::URL_PATH_EDIT,
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        $this->escaper=$escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource):array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['popup_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['popup_id' => $item['popup_id']]),
                        'label' => __('Edit'),
                    ];
                    $title = $this->escaper->escapeHtml($item['name']);
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['popup_id' => $item['popup_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $title),
                            'message' => __('Are you sure you want to delete a %1 record?', $title),
                        ],
                        'post' => true,
                    ];
                }
            }
        }

        return $dataSource;
    }

}
