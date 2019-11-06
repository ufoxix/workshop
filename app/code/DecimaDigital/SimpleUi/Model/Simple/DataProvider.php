<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Model\Simple;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\Collection;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\CollectionFactory;
use DecimaDigital\SimpleUi\Model\SimpleUiFactory;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;

/**
 * Class DataProvider
 *
 * @package DecimaDigital\SimpleUi\Model\Simple
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    private $loadedData;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var SimpleUiRepositoryInterface
     */
    private $repository;

    /**
     * @var SimpleUiFactory
     */
    private $simpleUiFactory;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $simpleUiCollection
     * @param RequestInterface $request
     * @param SimpleUiRepositoryInterface $repository
     * @param SimpleUiFactory $simpleUiFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $simpleUiCollection,
        RequestInterface $request,
        SimpleUiRepositoryInterface $repository,
        SimpleUiFactory $simpleUiFactory,
        array $meta = [],
        array $data = []
    ) {

        $this->collection = $simpleUiCollection->create();
        $this->request = $request;
        $this->repository = $repository;
        $this->simpleUiFactory = $simpleUiFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     * @throws \Exception
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        /** @var SimpleUiInterface $simpleUiEntity */
        $simpleUiEntity = $this->getCurrentSimpleUi();
        if ($simpleUiEntity->getEntityId()) {
            $this->loadedData[$simpleUiEntity->getEntityId()] = $simpleUiEntity->getData();
        }

        return $this->loadedData;
    }

    /**
     * Get current benefit data
     *
     * @return SimpleUiInterface
     * @throws \Exception
     */
    public function getCurrentSimpleUi(): SimpleUiInterface
    {
        $simpleUiEntity = $this->simpleUiFactory->create();
        $requestId = (int) $this->request->getParam($this->requestFieldName);
        if ($requestId) {
            $simpleUiEntity = $this->repository->getById($requestId);
        }

        return $simpleUiEntity;
    }
}
