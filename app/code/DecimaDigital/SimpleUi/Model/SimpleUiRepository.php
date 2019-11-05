<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Model;

use DecimaDigital\SimpleUi\Api\Data\SimpleUiSearchResultInterface;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiSearchResultInterfaceFactory;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi as SimpleUiResource;
use DecimaDigital\SimpleUi\Model\SimpleUiFactory;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\Collection;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

/**
 * Class SimpleUiRepository
 *
 * @package DecimaDigital\SimpleUi\Model
 */
class SimpleUiRepository implements SimpleUiRepositoryInterface
{
    /**
     * @var SimpleUiResource
     */
    private $simpleUiResource;

    /**
     * @var SimpleUiFactory
     */
    private $simpleUiFactory;

    /**
     * @var SimpleUiSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * RequestsRepository constructor.
     *
     * @param SimpleUiResource $simpleUiResource
     * @param SimpleUiFactory $simpleUiFactory
     * @param SimpleUiSearchResultInterfaceFactory $searchResultFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        SimpleUiResource $simpleUiResource,
        SimpleUiFactory $simpleUiFactory,
        SimpleUiSearchResultInterfaceFactory $searchResultFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->simpleUiResource = $simpleUiResource;
        $this->simpleUiFactory = $simpleUiFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function getById(int $simpleUiId): SimpleUiInterface
    {
        /** @var SimpleUi $simpleUiEntity */
        $simpleUiEntity = $this->simpleUiFactory->create();
        $this->simpleUiResource->load($simpleUiEntity, $simpleUiId, 'entity_id');

        if (!$simpleUiEntity->getId()) {
            throw new NoSuchEntityException(__('SimpleUiEntity "%1" does not exist.', $simpleUiEntity));
        }

        return $simpleUiEntity;
    }

    /**
     * @inheritDoc
     * @throws CouldNotSaveException
     */
    public function save(SimpleUiInterface $simpleEntity): SimpleUiInterface
    {
        try {
            $this->simpleUiResource->save($simpleEntity);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the object: %1', $exception->getMessage()),
                $exception
            );
        }
        return $simpleEntity;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SimpleUiSearchResultInterface
    {
        /** @var SimpleUiSearchResultInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $simpleUiId): SimpleUiInterface
    {
        try {
            $simpleUiEntity = $this->getById($simpleUiId);
            $this->simpleUiResource->delete($simpleUiEntity);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the object: %1', $exception->getMessage()),
                $exception
            );
        }
        return $simpleUiEntity;
    }
}
