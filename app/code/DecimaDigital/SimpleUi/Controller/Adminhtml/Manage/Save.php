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
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;
use DecimaDigital\SimpleUi\Model\SimpleUi;
use DecimaDigital\SimpleUi\Model\SimpleUiFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;

/**
 * Class Save
 *
 * @package DecimaDigital\SimpleUi\Controller\Adminhtml\Manage
 */
class Save extends Action implements HttpPostActionInterface
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
     * @var DateTimeFactory
     */
    private $dateTimeFactory;

    /**
     * Save SimpleUiEntity constructor.
     *
     * @param Context $context
     * @param SimpleUiRepositoryInterface $repository
     * @param SimpleUiFactory $simpleUiFactory
     * @param DateTimeFactory $dateTimeFactory
     */
    public function __construct(
        Context $context,
        SimpleUiRepositoryInterface $repository,
        SimpleUiFactory $simpleUiFactory,
        DateTimeFactory $dateTimeFactory
    ) {
        parent::__construct($context);
        $this->repository = $repository;
        $this->simpleUiFactory = $simpleUiFactory;
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * Show saving SimpleUiEntity data
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
            }

            $postData = $this->getRequest()->getPostValue();
            $this->valuesPreProcessing($simpleUiEntity, $postData);
            $this->repository->save($simpleUiEntity);
            $this->messageManager->addSuccessMessage(__('SimpleUi configuration has been saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * Preparing SimpleUiEntity saving data
     *
     * @param SimpleUiInterface $simpleUiEntity
     * @param array $post
     * @return SimpleUiInterface
     */
    private function valuesPreProcessing(
        SimpleUiInterface $simpleUiEntity,
        array $post = []
    ): SimpleUiInterface {
        if (empty($post['entity_id'])) {
            $post['entity_id'] = null;
            $post['created_at'] = $this->getCurrentDateTime();
        }
        /** @var SimpleUi $simpleUiEntity */
        $simpleUiEntity->addData($post);
        return $simpleUiEntity;
    }

    /**
     * Get current datetime
     *
     * @return string
     */
    private function getCurrentDateTime(): string
    {
        /** @var DateTime $date */
        $date = $this->dateTimeFactory->create();
        return (string) $date->gmtDate();
    }
}
