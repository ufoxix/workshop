<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\AjaxSimpleUi\Controller\Adminhtml\Manage;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;

/**
 * Class Edit
 *
 * @package DecimaDigital\AjaxSimpleUi\Controller\Adminhtml\Manage
 */
class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'DecimaDigital_AjaxSimpleUi::magento_ajax_simple_ui_app';

    /**
     * @var SimpleUiRepositoryInterface
     */
    private $repository;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param SimpleUiRepositoryInterface $repository
     */
    public function __construct(
        Context $context,
        SimpleUiRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct($context);
    }

    /**
     * PartnerProduct classes edit action
     *
     * @return ResponseInterface|Redirect|ResultInterface|void
     */
    public function execute()
    {
        $entityId = (int) $this->getRequest()->getParam('entity_id');
        if ($entityId) {
            try {
                $this->repository->getById($entityId);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                return $resultRedirect->setPath('*/*/index');
            }
        }

        $this->_view->loadLayout();
        $this->_setActiveMenu(
            self::ADMIN_RESOURCE
        )->_addBreadcrumb(
            __('Entity Information'),
            __('Entity Information')
        );

        if ($entityId) {
            $this->_view->getPage()->getConfig()->getTitle()
                ->prepend(__('Edit Entity "%1"', $this->getSimpleUiName($entityId)));
            $this->_view->renderLayout();
        } else {
            $this->_view->getPage()->getConfig()->getTitle()->prepend(__('New Partner Product'));
            return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        }
    }

    /**
     * Get SimpleUi name
     *
     * @param int $simpleId
     * @return string|null
     */
    private function getSimpleUiName(int $simpleId): ?string
    {
        $simpleName = null;
        $simpleEntity = $this->repository->getById($simpleId);
        if ($simpleEntity) {
            $simpleName = $simpleEntity->getName();
        }
        return $simpleName;
    }
}
