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
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use DecimaDigital\SimpleUi\Api\SimpleUiRepositoryInterface;

/**
 * Class Delete
 *
 * @package DecimaDigital\AjaxSimpleUi\Controller\Adminhtml\Manage
 */
class Delete extends AbstractAction implements HttpPostActionInterface
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
     * Delete constructor.
     *
     * @param Context $context
     * @param SimpleUiRepositoryInterface $repository
     */
    public function __construct(
        Context $context,
        SimpleUiRepositoryInterface $repository
    ) {
        parent::__construct($context);
        $this->repository = $repository;
    }

    /**
     * Delete partner product action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $customerId = (int) $this->getRequest()->getParam('id', false);
        $error = false;
        $message = '';

        if ($customerId && $this->_formKeyValidator->validate($this->getRequest())) {
            try {
                $simpleEntity = $this->repository->getById($customerId);
                if ($simpleEntity) {
                    $this->repository->deleteById($customerId);
                    $message = __('SimpleUi entity has been deleted.');
                }
            } catch (\Exception $exception) {
                $error = true;
                $message = __($exception->getMessage());
            }
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData(
            [
                'message' => $message,
                'error' => $error,
                'data' => [
                    'entity_id' => $customerId
                ]
            ]
        );

        return $resultJson;
    }
}
