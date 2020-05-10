<?php

declare(strict_types=1);

namespace Sergey\ServiceContract\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Sergey\ServiceContract\Api\Data\SergeyPoolScInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface SergeyPoolScRepositoryInterface
 *
 * @package Sergey\ServiceContract\Api
 */
interface SergeyPoolScRepositoryInterface
{
    /**
     * Load SergeyPoolId by id
     *
     * @param int $SergeyPoolId
     * @return SergeyPoolScInterface
     */
    public function getById(int $SergeyPoolId): SergeyPoolScInterface;

    /**
     * Save SergeyPoolEntity data
     *
     * @param SergeyPoolScInterface $SergeyPoolEntity
     * @return SergeyPoolScInterface
     */
    public function save(SergeyPoolScInterface $SergeyPoolEntity): SergeyPoolScInterface;

    /**
     * Retrieve List which match a specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Delete SergeyPoolId by id
     *
     * @param int $SergeyPoolId
     *
     * @return SergeyPoolScInterface
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $SergeyPoolId): SergeyPoolScInterface;
}
