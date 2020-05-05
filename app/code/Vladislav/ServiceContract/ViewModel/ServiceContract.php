<?php


namespace Vladislav\ServiceContract\ViewModel;

use Vladislav\ServiceContract\Api\VladislavScRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;
/**
 * Class ServiceContract
 *
 * @package Vladislav\ServiceContract\ViewModel
 */
class ServiceContract implements ArgumentInterface
{
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var VladislavScRepositoryInterface
     */
    private $vladislavScRepository;

    /**
     * ServiceContract constructor.
     *
     * @param VladislavScRepositoryInterface $vladislavScRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        VladislavScRepositoryInterface $vladislavScRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->vladislavScRepository = $vladislavScRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Get all records from andrey_service_contract_sc_table
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function scRepository()
    {
        return $this->vladislavScRepository->getList($this->searchCriteriaBuilder->create());
    }
}
