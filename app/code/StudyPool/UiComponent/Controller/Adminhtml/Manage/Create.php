<?php

declare(strict_types=1);

namespace StudyPool\UiComponent\Controller\Adminhtml\Manage;

use Magento\Backend\Model\View\Result\Forward;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\AbstractAction;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class Create
 *
 * @package StudyPool\UiComponent\Controller\Adminhtml\Manage
 */
class Create extends AbstractAction implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'StudyPool_UiComponent::ui_app';

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
