<?php

declare(strict_types=1);

namespace Andrey\ServiceContract\Api;

use Andrey\ServiceContract\Api\Data\AndyScInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface AndyScRepositoryInterface
 *
 * @package Andrey\ServiceContract\Api
 */
interface AndyScRepositoryInterface
{
    /**
     * Load andyId by id
     *
     * @param int $studyPoolId
     * @return AndyScInterface
     */
    public function getById(int $studyPoolId): AndyScInterface;

    /**
     * Save andyEntity data
     *
     * @param AndyScInterface $andyEntity
     * @return AndyScInterface
     */
    public function save(AndyScInterface $andyEntity): AndyScInterface;

    /**
     * Retrieve List which match a specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;

    /**
     * Delete andyId by id
     *
     * @param int $andyId
     *
     * @return AndyScInterface
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $andyId): AndyScInterface;
}
