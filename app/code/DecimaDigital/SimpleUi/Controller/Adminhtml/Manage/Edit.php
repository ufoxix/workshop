<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Controller\Adminhtml\Manage;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;

/**
 * Class Edit
 *
 * @package DecimaDigital\SimpleUi\Controller\Adminhtml\Manage
 */
class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'DecimaDigital_SimpleUi::magento_simple_ui_app';

    /**
     * @var SimpleUiRepositoryInterface
     */
    private $simpleUiRepository;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param SimpleUiRepositoryInterface $simpleUiRepository
     */
    public function __construct(
        Context $context,
        SimpleUiRepositoryInterface $simpleUiRepository
    ) {
        parent::__construct($context);
        $this->simpleUiRepository = $simpleUiRepository;
    }

    /**
     * SimpleUiEntity edit page
     *
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $entityId = (int) $this->getRequest()->getParam('entity_id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($entityId) {
            try {
                $simpleUiEntity = $this->simpleUiRepository->getById($entityId);
                $resultPage->setActiveMenu(self::ADMIN_RESOURCE);
                $resultPage->addBreadcrumb(__('Configure SimpleUi'), __('Configure SimpleUi'));
                $resultPage->getConfig()->getTitle()
                    ->prepend(__('Edit Configure SimpleUi Configuration'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/index');
            }
            $resultPage->getConfig()->getTitle()
                ->prepend(__('Edit SimpleUi Configuration for "%1"', $simpleUiEntity->getName()));
            return $resultPage;
        } else {
            $this->_view->getPage()->getConfig()->getTitle()->prepend(__('New SimpleUi Configuration'));
        }
        return $resultPage;
    }
}
