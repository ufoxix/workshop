<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\MiddleUi\Controller\Adminhtml\Manage;

use Magento\Backend\App\AbstractAction;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class Index
 *
 * @package DecimaDigital\MiddleUi\Controller\Adminhtml\Manage
 */
class Index extends AbstractAction implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'DecimaDigital_SimpleUi::magento_middle_ui_app';

    /**
     * MiddleUi classes list action
     *
     * @return void
     */
    public function execute(): void
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            self::ADMIN_RESOURCE
        )->_addBreadcrumb(
            __('Middle Ui App'),
            __('Middle Ui App')
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Manage Middle Ui App'));
        $this->_view->renderLayout();
    }
}
