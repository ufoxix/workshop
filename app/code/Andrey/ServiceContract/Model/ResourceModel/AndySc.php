<?php

declare(strict_types=1);

namespace Andrey\ServiceContract\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class AndySc
 *
 * @package Andrey\ServiceContract\Model\ResourceModel
 */
class AndySc extends AbstractDb
{
    /**
     * Resource initialization.
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('andrey_service_contract_sc_table', 'entity_id');
    }
}

