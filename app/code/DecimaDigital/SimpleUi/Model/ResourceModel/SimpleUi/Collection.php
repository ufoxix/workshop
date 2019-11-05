<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use DecimaDigital\SimpleUi\Model\SimpleUi as SimpleUiModel;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi as SimpleUiResourceModel;

/**
 * Class Collection
 *
 * @package DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi
 */
class Collection extends AbstractCollection
{
    /**
     * SimpleUi resource collection initialization.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            SimpleUiModel::class,
            SimpleUiResourceModel::class
        );
    }
}
