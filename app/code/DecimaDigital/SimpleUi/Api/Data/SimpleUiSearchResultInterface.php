<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface SimpleUiSearchResultInterface
 *
 * @package DecimaDigital\SimpleUi\Api\Data
 */
interface SimpleUiSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get items list
     *
     * @return SimpleUiInterface[]
     */
    public function getItems(): array;

    /**
     * Set items list
     *
     * @param SimpleUiInterface[] $items
     * @return SimpleUiSearchResultInterface
     */
    public function setItems(array $items): SimpleUiSearchResultInterface;
}
