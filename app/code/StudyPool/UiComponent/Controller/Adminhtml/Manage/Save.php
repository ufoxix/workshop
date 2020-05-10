<?php

declare(strict_types=1);

namespace StudyPool\UiComponent\Controller\Adminhtml\Manage;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use StudyPool\ServiceContract\Api\StudyPoolScRepositoryInterface;
use StudyPool\ServiceContract\Api\Data\StudyPoolScInterface;
use StudyPool\ServiceContract\Api\Data\StudyPoolScInterfaceFactory;
use StudyPool\ServiceContract\Model\StudyPoolSc;
use Psr\Log\LoggerInterface;

/**
 * Class Save
 *
 * @package StudyPool\UiComponent\Controller\Adminhtml\Manage
 */
class Save extends AbstractAction implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    public const ADMIN_RESOURCE = 'StudyPool_UiComponent::ui_app';

    /**
     * @var StudyPoolScRepositoryInterface
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var StudyPoolScInterfaceFactory
     */
    private $studyPoolFactory;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param StudyPoolScRepositoryInterface $repository
     * @param LoggerInterface $logger
     * @param StudyPoolScInterfaceFactory $studyPoolFactory
     */
    public function __construct(
        Context $context,
        StudyPoolScRepositoryInterface $repository,
        LoggerInterface $logger,
        StudyPoolScInterfaceFactory $studyPoolFactory
    ) {
        parent::__construct($context);
        $this->repository = $repository;
        $this->logger = $logger;
        $this->studyPoolFactory = $studyPoolFactory;
    }

    /**
     * Show saving Study Poll Ui data
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $entityId = (int) $this->getRequest()->getParam('entity_id');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $studyPoolSc = $this->studyPoolFactory->create();

        try {
            if ($entityId) {
                $studyPoolSc = $this->repository->getById($entityId);
            }

            $postData = $this->getRequest()->getPostValue();
            $this->preparePostData($studyPoolSc, $postData);
            $this->repository->save($studyPoolSc);
            $this->messageManager->addSuccessMessage(__('SimpleUi configuration has been saved.'));
        } catch (\Throwable $throwable) {
            $this->logger->critical($throwable->getMessage());
            $this->messageManager->addErrorMessage(__(
                'An error occured. Please, try again later.'
            ));
        }

        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * Preparing SimpleUiEntity saving data
     *
     * @param StudyPoolScInterface $studyPoolSc
     * @param array $post
     * @return StudyPoolScInterface
     */
    private function preparePostData(
        StudyPoolScInterface $studyPoolSc,
        array $post = []
    ): StudyPoolScInterface {
        if (empty($post['entity_id'])) {
            $post['entity_id'] = null;
        }

        /** TODO: Good practice implements data validation before data will be added to object */
        /** @var StudyPoolSc $studyPoolSc */
        $studyPoolSc->addData($post);

        return $studyPoolSc;
    }
}
