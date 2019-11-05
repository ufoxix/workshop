<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Model;

use Magento\Framework\Api\SearchResults;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiSearchResultInterface;

/**
 * Class SimpleUiSearchResults
 *
 * @package DecimaDigital\SimpleUi\Model
 */
class SimpleUiSearchResults extends SearchResults implements SimpleUiSearchResultInterface
{
    /**
     * @inheritDoc
     */
    public function getItems(): array // phpcs:ignore
    {
        return parent::getItems();
    }

    /**
     * @inheritDoc
     */
    public function setItems(array $items): SimpleUiSearchResultInterface
    {
        parent::setItems($items);
        return $this;
    }
}
