<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Api;

use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface SimpleUiRepository
 *
 * @package DecimaDigital\SimpleUi\Api
 */
interface SimpleUiRepositoryInterface
{
    /**
     * Load simpleUiEntity by id
     *
     * @param int $simpleUiId
     * @return SimpleUiInterface
     */
    public function getById(int $simpleUiId): SimpleUiInterface;

    /**
     * Save simpleUiEntity data
     *
     * @param SimpleUiInterface $simpleEntity
     * @return SimpleUiInterface
     */
    public function save(SimpleUiInterface $simpleEntity): SimpleUiInterface;

    /**
     * Retrieve List which match a specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SimpleUiSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SimpleUiSearchResultInterface;

    /**
     * Delete simpleUiEntity by id
     *
     * @param int $simpleUiId
     *
     * @return SimpleUiInterface
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $simpleUiId): SimpleUiInterface;
}
