<?php

declare(strict_types=1);

namespace StudyPool\UiComponent\Controller\Adminhtml\Manage;

use Magento\Backend\App\AbstractAction;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class Index
 *
 * @package StudyPool\UiComponent\Controller\Adminhtml\Manage
 */
class Index extends AbstractAction implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'StudyPool_UiComponent::ui_app';

    /**
     * UiComponent classes list action
     *
     * @return void
     */
    public function execute(): void
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            self::ADMIN_RESOURCE
        )->_addBreadcrumb(
            __('Study Poll Ui App'),
            __('Study Poll Ui App')
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Manage Study Poll Ui'));
        $this->_view->renderLayout();
    }
}
