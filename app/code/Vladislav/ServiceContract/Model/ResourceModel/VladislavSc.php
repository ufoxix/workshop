<?php

declare(strict_types=1);

namespace Vladislav\ServiceContract\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class VladislavSc
 *
 * @package Vladislav\ServiceContract\Model\ResourceModel
 */
class VladislavSc extends AbstractDb
{
    /**
     * Resource initialization.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('vladislav_service_contract_sc_table', 'entity_id');
    }
}
