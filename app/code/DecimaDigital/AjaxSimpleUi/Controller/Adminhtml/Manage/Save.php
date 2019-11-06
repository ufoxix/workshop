<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\AjaxSimpleUi\Controller\Adminhtml\Manage;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;
use DecimaDigital\SimpleUi\Model\SimpleUiFactory;

/**
 * Class Save
 *
 * @package DecimaDigital\AjaxSimpleUi\Controller\Adminhtml\Manage
 */
class Save extends AbstractAction implements HttpPostActionInterface
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
     * @var SimpleUiFactory
     */
    private $simpleFactory;

    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var DateTimeFactory
     */
    private $dateTimeFactory;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param SimpleUiRepositoryInterface $repository
     * @param SimpleUiFactory $simpleFactory
     * @param JsonFactory $resultJsonFactory
     * @param DateTimeFactory $dateTimeFactory
     */
    public function __construct(
        Context $context,
        SimpleUiRepositoryInterface $repository,
        SimpleUiFactory $simpleFactory,
        JsonFactory $resultJsonFactory,
        DateTimeFactory $dateTimeFactory
    ) {
        parent::__construct($context);
        $this->repository = $repository;
        $this->simpleFactory = $simpleFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * Save partner product data
     *
     * @return Json
     */
    public function execute()
    {
        $entityId = (int) $this->getRequest()->getParam('entity_id');
        $simpleEntity = $this->simpleFactory->create();
        $error = false;

        try {
            if ($entityId) {
                $simpleEntity = $this->repository->getById($entityId);
            }

            $postData = $this->getRequest()->getPostValue();
            $this->valuesPreProcessing($simpleEntity, $postData);
            $this->repository->save($simpleEntity);
            $message = __('Simple Ui entity has been updated.');
        } catch (\Exception $e) {
            $error = true;
            $message = __($e->getMessage());
        }

        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData(
            [
                'message' => $message,
                'error' => $error,
                'data' => [
                    'entity_id' => $entityId
                ]
            ]
        );

        return $resultJson;
    }

    /**
     * Preparing SimpleEntity saving data
     *
     * @param SimpleUiInterface $simpleEntity
     * @param array $post
     * @return SimpleUiInterface
     */
    protected function valuesPreProcessing(
        SimpleUiInterface $simpleEntity,
        array $post = []
    ): SimpleUiInterface {
        if (empty($post['entity_id'])) {
            $post['entity_id'] = null;
            $post['created_at'] = $this->getCurrentDateTime();
        }
        $simpleEntity->setData($post);

        return $simpleEntity;
    }

    /**
     * Get current datetime
     *
     * @return string
     */
    protected function getCurrentDateTime(): string
    {
        /** @var DateTime $date */
        $date = $this->dateTimeFactory->create();
        return (string) $date->gmtDate();
    }
}
