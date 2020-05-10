<?php

declare(strict_types=1);

namespace Sergey\ServiceContract\Model\ResourceModel\SergeyPoolSc;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sergey\ServiceContract\Model\SergeyPoolSc as SergeyPoolScModel;
use Sergey\ServiceContract\Model\ResourceModel\SergeyPoolScRes ;

/**
 * Class Collection
 *
 * @package Sergey\ServiceContract\Model\ResourceModel\SergeyPoolSc
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
            SergeyPoolScModel::class,
            SergeyPoolScRes::class
        );
    }
}
