<?php
declare(strict_types=1);
namespace MageMastery\Popup\Block\Adminhtml\Popup\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData():array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'magemastery_popup_form.magemastery_popup_form',
                                'actionName' => 'save',
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }

}
