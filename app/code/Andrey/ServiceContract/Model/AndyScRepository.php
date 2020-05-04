<?php

declare(strict_types=1);

namespace Andrey\ServiceContract\Model;

use Andrey\ServiceContract\Api\Data\AndyScInterface;
use Andrey\ServiceContract\Api\Data\AndyScInterfaceFactory;
use Andrey\ServiceContract\Api\AndyScRepositoryInterface;
use Andrey\ServiceContract\Model\ResourceModel\AndySc as ResourceModel;
use Andrey\ServiceContract\Model\ResourceModel\StudyPoolSc\Collection;
use Andrey\ServiceContract\Model\ResourceModel\StudyPoolSc\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AndyScRepository
 *
 * @package Andrey\ServiceContract\Model
 */
class AndyScRepository implements AndyScRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    private $andyResource;

    /**
     * @var AndyScInterfaceFactory
     */
    private $andyFactory;

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
     * AndyScRepository constructor.
     *
     * @param ResourceModel $andyResource
     * @param AndyScInterfaceFactory $andyFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        ResourceModel $andyResource,
        AndyScInterfaceFactory $andyFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultFactory
    ) {
        $this->andyResource = $andyResource;
        $this->andyFactory = $andyFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @inheritDoc
     *
     * @throws NoSuchEntityException
     */
    public function getById(int $andyId): AndyScInterface
    {
        /** @var AndyScInterface $andy */
        $andy = $this->andyFactory->create();
        $this->andyResource->load($andy, $andyId, 'entity_id');

        if (!$andy->getId()) {
            throw new NoSuchEntityException(__('StudyPoolEntity "%1" does not exist.', $andy));
        }

        return $andy;
    }

    /**
     * @inheritDoc
     *
     * @throws CouldNotSaveException
     */
    public function save(AndyScInterface $andyEntity): AndyScInterface
    {
        try {
            $this->andyResource->save($andyEntity);
        } catch (\Throwable $throwable) {
            throw new CouldNotSaveException(
                __('Could not save the object: %1', $throwable->getMessage()),
                $throwable
            );
        }
        return $andyEntity;
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
    public function deleteById(int $andyId): AndyScInterface
    {
        try {
            $andy = $this->getById($andyId);
            $this->andyResource->delete($andy);
        } catch (\Throwable $throwable) {
            throw new CouldNotDeleteException(
                __('Could not delete the object: %1', $throwable->getMessage()),
                $throwable
            );
        }
        return $andy;
    }
}

