<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class SimpleUi
 *
 * @package DecimaDigital\SimpleUi\Model\ResourceModel
 */
class SimpleUi extends AbstractDb
{
    /**
     * Resource initialization.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('dd_simple_ui', 'entity_id');
    }
}
