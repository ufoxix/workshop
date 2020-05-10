<?php

declare(strict_types=1);

namespace Vladislav\ServiceContract\Api;

use Vladislav\ServiceContract\Api\Data\VladislavScInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface VladislavScRepositoryInterface
 *
 * @package Vladislav\ServiceContract\Api
 */
interface VladislavScRepositoryInterface
{
    /**
     * Load VladislavId by id
     *
     * @param int $vladislavId
     * @return VladislavScInterface
     */

    public function getById(int $vladislavId):VladislavScInterface;

    /**
     * Save VladislavEntity data
     *
     * @param VladislavScInterface $VladislavEntity
     * @return VladislavScInterface
     */

    public function save(VladislavPoolScInterface $vladislavEntity): VladislavScInterface;

    /**
     * Retrieve List which match a specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */

    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Delete VladislavId by id
     *
     * @param int $VladislavId
     *
     * @return VladislavScInterface
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function DeleteById(int $vladislavId): VladislavScInterface;
}
