<?php

declare(strict_types=1);

namespace Sergey\ServiceContract\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class SergeyPoolScRes
 *
 * @package Sergey\ServiceContract\Model\ResourceModel
 */
class SergeyPoolScRes extends AbstractDb
{
    /**
     * Resource initialization.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('sergey_servicecontract_sc', 'entity_id');
    }
}
