<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\AjaxSimpleUi\Model\AjaxUi;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\Collection;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\CollectionFactory;
use DecimaDigital\SimpleUi\Model\SimpleUiFactory;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;
use Magento\Framework\Session\SessionManagerInterface;

/**
 * Class DataProvider
 *
 * @package DecimaDigital\AjaxSimpleUi\Model\AjaxUi
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

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
    private $simpleFactory;

    /**
     * @var SessionManagerInterface
     */
    private $sessionManager;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $simpleCollection
     * @param RequestInterface $request
     * @param SimpleUiRepositoryInterface $repository
     * @param SimpleUiFactory $simpleFactory
     * @param SessionManagerInterface $sessionManager
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $simpleCollection,
        RequestInterface $request,
        SimpleUiRepositoryInterface $repository,
        SimpleUiFactory $simpleFactory,
        SessionManagerInterface $sessionManager,
        array $meta = [],
        array $data = []
    ) {

        $this->collection = $simpleCollection->create();
        $this->request = $request;
        $this->repository = $repository;
        $this->simpleFactory = $simpleFactory;
        $this->sessionManager = $sessionManager;
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
        /** @var SimpleUiInterface $simpleEntity */
        $simpleEntity = $this->getCurrentPartnerService();
        if ($simpleEntity->getEntityId()) {
            $this->loadedData[$simpleEntity->getEntityId()] = $simpleEntity->getData();
            $this->sessionManager->setSimpleUiData($simpleEntity);
        }

        return $this->loadedData;
    }

    /**
     * Get current simpleUi data
     *
     * @return SimpleUiInterface
     * @throws \Exception
     */
    public function getCurrentPartnerService(): SimpleUiInterface
    {
        $simpleEntity = $this->simpleFactory->create();
        $requestId = (int) $this->request->getParam($this->requestFieldName);
        if ($requestId) {
            $simpleEntity = $this->repository->getById($requestId);
        }

        return $simpleEntity;
    }
}
