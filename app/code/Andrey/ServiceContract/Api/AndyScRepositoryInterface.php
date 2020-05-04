<?php

declare(strict_types=1);

namespace Andrey\ServiceContract\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Andrey\ServiceContract\Api\Data\AndyScInterface;
use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface AndyScRepositoryInterface
 *
 * @package Andrey\ServiceContract\Api
 */
interface AndyScRepositoryInterface
{
    /**
     * Load studyPoolId by id
     *
     * @param int $studyPoolId
     * @return AndyScInterface
     */
    public function getById(int $studyPoolId): AndyScInterface;

    /**
     * Save studyPoolEntity data
     *
     * @param AndyScInterface $studyPoolEntity
     * @return AndyScInterface
     */
    public function save(AndyScInterface $studyPoolEntity): AndyScInterface;

    /**
     * Retrieve List which match a specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Delete studyPoolId by id
     *
     * @param int $studyPoolId
     *
     * @return AndyScInterface
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $studyPoolId): AndyScInterface;
}
