<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\AjaxSimpleUi\Ui\Component\Listing\Column\Ajax;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Actions
 *
 * @package DecimaDigital\AjaxSimpleUi\Ui\Component\Listing\Column\Ajax
 */
class Actions extends Column
{
    private const URL_PATH_DELETE = 'dd_ajax/manage/delete';
    private const FORM_AREA = 'customer_form.areas.simple_ui_information.simple_ui_information';

    /**
     * URL builder
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * ManageActions constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['entity_id'])) {
                    $item[$name]['edit'] = [
                        'callback' => [
                            [
                                'provider' => self::FORM_AREA
                                    . '.dd_ajax_manage_update_modal.update_dd_ajax_manage_form_loader',
                                'target' => 'destroyInserted',
                            ],
                            [
                                'provider' => self::FORM_AREA . '.dd_ajax_manage_update_modal',
                                'target' => 'openModal',
                            ],
                            [
                                'provider' => self::FORM_AREA
                                    . '.dd_ajax_manage_update_modal.update_dd_ajax_manage_form_loader',
                                'target' => 'render',
                                'params' => [
                                    'entity_id' => $item['entity_id'],
                                    'customer_id' => $item['customer_id']
                                ],
                            ]
                        ],
                        'href' => '#',
                        'label' => __('Edit'),
                        'hidden' => false,
                    ];

                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(
                            self::URL_PATH_DELETE,
                            ['customer_id' => $item['customer_id'], 'id' => $item['entity_id']]
                        ),
                        'label' => __('Delete'),
                        'isAjax' => true,
                        'confirm' => [
                            'title' => __('Delete entity'),
                            'message' => __('Are you sure you want to delete the entity?')
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
