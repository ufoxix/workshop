<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\MiddleUi\ViewModel\Data;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;
use Magento\Framework\App\RequestInterface;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\Collection;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\CollectionFactory;

/**
 * Class CustomData
 *
 * @package DecimaDigital\MiddleUi\ViewModel\Data
 */
class CustomData implements ArgumentInterface
{
    /**
     * @var SimpleUiRepositoryInterface
     */
    private $repository;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var Collection
     */
    private $collection;

    /**
     * CustomData constructor.
     *
     * @param SimpleUiRepositoryInterface $repository
     * @param RequestInterface $request
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        SimpleUiRepositoryInterface $repository,
        RequestInterface $request,
        CollectionFactory $collectionFactory
    ) {
        $this->repository = $repository;
        $this->request = $request;
        $this->collection = $collectionFactory->create();
    }

    /**
     * Get collection data
     *
     * @return array
     */
    public function getAllEntityData(): array
    {
        if (isset($this->collection)) {
            return $this->collection->getData();
        }
        /** @var Collection $collection */
        $collection = $this->collection->getData();
        if (!empty($collection)) {
            $this->collection = $collection;
        }
        return $this->collection;
    }

    /**
     * Get current SimpleUi data
     *
     * @return SimpleUiInterface|null
     */
    public function getData(): ?SimpleUiInterface
    {
        $requestId = $this->getRequestId();
        $simpleUiEntity = null;
        if ($requestId) {
            $simpleUiEntity = $this->repository->getById($requestId);
        }
        return $simpleUiEntity;
    }

    /**
     * Get current request id
     *
     * @return int
     */
    private function getRequestId(): int
    {
        $requestId = 0;
        $request = (int) $this->request->getParam('entity_id');
        if ($request) {
            $requestId = $request;
        }
        return $requestId;
    }
}
