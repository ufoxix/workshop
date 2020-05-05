<?php

declare(strict_types=1);

namespace Vladislav\ServiceContract\Model\ResourceModel\VladislavPoolSc;

use Vladislav\ServiceContract\Model\VladislavSc as VladislavScModel;
use Vladislav\ServiceContract\Model\ResourceModel\VladislavSc as VladislavScResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package Vladislav\ServiceContract\Model\ResourceModel\VladislavSc
 */

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            VladislavScModel::class,
            VladislavScResourceModel::class
        );
    }
}
