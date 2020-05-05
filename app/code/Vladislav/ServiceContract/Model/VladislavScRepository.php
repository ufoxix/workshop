<?php


namespace Vladislav\ServiceContract\Model;

use Vladislav\ServiceContract\Api\Data\VladislavScInterface;
use Vladislav\ServiceContract\Api\Data\VladislavScInterfaceFactory;
use Vladislav\ServiceContract\Api\VladislavScRepositoryInterface;
use Vladislav\ServiceContract\Model\ResourceModel\VladislavSc as ResourceModel;
use Vladislav\ServiceContract\Model\ResourceModel\VladislavPoolSc\Collection;
use Vladislav\ServiceContract\Model\ResourceModel\VladislavPoolSc\CollectionFactory;
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
 * @package Vladislav\ServiceContract\Model
 */
class VladislavScRepository implements VladislavScRepositoryInterface
{
    /*
     * @var ResourceModel
     */
    private $vladislavResource;

    /**
     * @var VladislavScInterfaceFactory
     */
    private $vladislavFactory;

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
     * VladislavScRepository constructor.
     *
     * @param ResourceModel $vladislavResource
     * @param AndyScInterfaceFactory $vladislavFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        ResourceModel $vladislavResource,
        VladislavScInterface $vladislavFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultFactory
    ) {
        $this->vladislavResource = $vladislavResource;
        $this->vladislavFactory = $vladislavFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultFactory = $searchResultFactory;
    }

    /**
     * @inheritDoc
     *
     * @throws NoSuchEntityException
     */
    public function getById(int $vladislavId): VladislavScInterface
    {
        /** @var VladislavScInterface $andy */
        $vladislav = $this->vladislavFactory->create();
        $this->vladislavResource->load($vladislav, $vladislavId, 'entity_id');

        if (!$vladislav->getId()) {
            throw new NoSuchEntityException(__('StudyPoolEntity "%1" does not exist.', $vladislav));
        }

        return $vladislav;
    }

    /**
     * @inheritDoc
     *
     * @throws CouldNotSaveException
     */
    public function save(VladislavScInterface $vladislavEntity): VladislavScInterface
    {
        try {
            $this->vladislavResource->save($vladislavEntity);
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
    public function deleteById(int $vladislavId): VladislavScInterface
    {
        try {
            $vladislav = $this->getById($vladislavId);
            $this->avladislavResource->delete($vladislav);
        } catch (\Throwable $throwable) {
            throw new CouldNotDeleteException(
                __('Could not delete the object: %1', $throwable->getMessage()),
                $throwable
            );
        }
        return $avladislav;
    }
}
