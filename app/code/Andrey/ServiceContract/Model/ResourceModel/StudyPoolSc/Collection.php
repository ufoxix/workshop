<?php

declare(strict_types=1);

namespace Andrey\ServiceContract\Model\ResourceModel\StudyPoolSc;

use Andrey\ServiceContract\Model\AndySc as AndyScModel;
use Andrey\ServiceContract\Model\ResourceModel\AndySc as AndyScResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package Andrey\ServiceContract\Model\ResourceModel\AndySc
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
            AndyScModel::class,
            AndyScResourceModel::class
        );
    }
}
