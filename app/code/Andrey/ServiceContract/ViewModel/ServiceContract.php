<?php

namespace Andrey\ServiceContract\ViewModel;

use Andrey\ServiceContract\Api\AndyScRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class ServiceContract
 *
 * @package Andrey\ServiceContract\ViewModel
 */
class ServiceContract implements ArgumentInterface
{

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var AndyScRepositoryInterface
     */
    private $andyScRepository;

    /**
     * ServiceContract constructor.
     *
     * @param AndyScRepositoryInterface $andyScRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        AndyScRepositoryInterface $andyScRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->andyScRepository = $andyScRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Get all records from andrey_service_contract_sc_table
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function scRepository()
    {
        return $this->andyScRepository->getList($this->searchCriteriaBuilder->create());
    }
}
