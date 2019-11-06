<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\AjaxSimpleUi\Ui\Component\Listing\Ajax;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\CollectionFactory;

/**
 * Class DataProvider
 *
 * @package DecimaDigital\AjaxSimpleUi\Ui\Component\Listing\Ajax
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param RequestInterface $request
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        RequestInterface $request,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData()
    {
        if ($customerId = $this->getCustomerId()) {
            $this->getCollection()->addFieldToFilter('customer_id', ['eq' => $customerId]);
        }
        if ($entityId = $this->getSimpleUiId()) {
            $this->getCollection()->addFieldToFilter('entity_id', ['eq' => $entityId]);
        }

        return parent::getData();
    }

    /**
     * Get customer id.
     *
     * @return int
     */
    private function getCustomerId(): int
    {
        return (int) $this->request->getParam('customer_id');
    }

    /**
     * Get simpleEntityId
     *
     * @return int
     */
    private function getSimpleUiId(): int
    {
        return (int) $this->request->getParam('entity_id');
    }
}
