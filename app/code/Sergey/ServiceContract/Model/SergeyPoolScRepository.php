<?php

declare(strict_types=1);

namespace Sergey\ServiceContract\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Sergey\ServiceContract\Api\Data\SergeyPoolScInterface;
use Sergey\ServiceContract\Api\Data\SergeyPoolScInterfaceFactory;
use Sergey\ServiceContract\Api\SergeyPoolScRepositoryInterface;
use Sergey\ServiceContract\Model\ResourceModel\SergeyPoolScRes;
use Sergey\ServiceContract\Model\SergeyPoolScFactory;
use Sergey\ServiceContract\Model\ResourceModel\SergeyPoolSc\Collection;
use Sergey\ServiceContract\Model\ResourceModel\SergeyPoolSc\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

/**
 * Class SergeyPoolScRepository
 *
 * @package Sergey\ServiceContract\Model
 */
class SergeyPoolScRepository implements SergeyPoolScRepositoryInterface
{
    /**
     * @var SergeyPoolScRes
     */
    private $sergeyPoolResource;

    /**
     * @var SergeyPoolScInterfaceFactory
     */
    private $sergeyPoolFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * SergeyPoolScRepository constructor.
     *
     * @param SergeyPoolScRes $sergeyPoolResource
     * @param SergeyPoolScInterfaceFactory $sergeyPoolFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        SergeyPoolScRes $sergeyPoolResource,
        SergeyPoolScInterfaceFactory $sergeyPoolFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultFactory
    ) {
        $this->sergeyPoolResource = $sergeyPoolResource;
        $this->sergeyPoolFactory = $sergeyPoolFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @inheritDoc
     *
     * @throws NoSuchEntityException
     */
    public function getById(int $sergeyPoolId): SergeyPoolScInterface
    {
        /** @var SergeyPoolScInterface $sergeyPool */
        $sergeyPool = $this->sergeyPoolFactory->create();
        $this->sergeyPoolResource->load($sergeyPool, $sergeyPoolId, 'entity_id');

        if (!$sergeyPool->getId()) {
            throw new NoSuchEntityException(__('StudyPoolEntity "%1" does not exist.', $sergeyPool));
        }

        return $sergeyPool;
    }

    /**
     * @inheritDoc
     *
     * @throws CouldNotSaveException
     */
    public function save(SergeyPoolScInterface $sergeyPoolEntity): SergeyPoolScInterface
    {
        try {
            $this->sergeyPoolResource->save($sergeyPoolEntity);
        } catch (\Throwable $throwable) {
            throw new CouldNotSaveException(
                __('Could not save the object: %1', $throwable->getMessage()),
                $throwable
            );
        }
        return $sergeyPoolEntity;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface
    {
        /** @var SearchResultsInterface $searchResult */
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
    public function deleteById(int $sergeyPoolId): SergeyPoolScInterface
    {
        try {
            $sergeyPool = $this->getById($sergeyPoolId);
            $this->sergeyPoolResource->delete($sergeyPool);
        } catch (\Throwable $throwable) {
            throw new CouldNotDeleteException(
                __('Could not delete the object: %1', $throwable->getMessage()),
                $throwable
            );
        }
        return $sergeyPool;
    }
}
