<?php

namespace Sergey\ServiceContract\ViewModel;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Sergey\ServiceContract\Api\SergeyPoolScRepositoryInterface;

class Test implements ArgumentInterface
{
    /**
     * @var SergeyPoolScRepositoryInterface
     */
    private $sergeyRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Test constructor.
     * @param SergeyPoolScRepositoryInterface $sergeyRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        SergeyPoolScRepositoryInterface $sergeyRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->sergeyRepository = $sergeyRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return \Magento\Cms\Api\Data\PageInterface[]
     */
    public function getItems()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $sergeySearchResult = $this->sergeyRepository->getList($searchCriteria);

        return $sergeySearchResult->getItems();
    }
}
