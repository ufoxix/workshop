<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Controller\Adminhtml\Manage;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;
use DecimaDigital\SimpleUi\Model\SimpleUiFactory;

/**
 * Class Delete
 *
 * @package DecimaDigital\SimpleUi\Controller\Adminhtml\Manage
 */
class Delete extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'DecimaDigital_SimpleUi::magento_simple_ui_app';

    /**
     * @var SimpleUiRepositoryInterface
     */
    private $repository;

    /**
     * @var SimpleUiFactory
     */
    private $simpleUiFactory;

    /**
     * Delete SimpleUiEntity constructor.
     *
     * @param Context $context
     * @param SimpleUiRepositoryInterface $repository
     * @param SimpleUiFactory $simpleUiFactory
     */
    public function __construct(
        Context $context,
        SimpleUiRepositoryInterface $repository,
        SimpleUiFactory $simpleUiFactory
    ) {
        parent::__construct($context);
        $this->repository = $repository;
        $this->simpleUiFactory = $simpleUiFactory;
    }

    /**
     * Show deleting SimpleUiEntity data
     *
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $entityId = (int) $this->getRequest()->getParam('entity_id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $simpleUiEntity = $this->simpleUiFactory->create();

        try {
            if ($entityId) {
                $simpleUiEntity = $this->repository->getById($entityId);
                if ($simpleUiEntity) {
                    $this->repository->deleteById($simpleUiEntity->getEntityId());
                }
            }
            $this->messageManager->addSuccessMessage(__('SimpleUi configuration has been deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
