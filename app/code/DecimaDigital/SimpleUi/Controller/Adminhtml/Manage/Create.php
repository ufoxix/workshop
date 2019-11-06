<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Controller\Adminhtml\Manage;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\Model\View\Result\Forward;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Create
 *
 * @package DecimaDigital\SimpleUi\Controller\Adminhtml\Manage
 */
class Create extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'DecimaDigital_SimpleUi::magento_simple_ui_app';


    /**
     * Forward to edit
     *
     * @return Forward
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)->forward('edit');
    }
}
