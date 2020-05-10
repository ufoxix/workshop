<?php

declare(strict_types=1);

namespace StudyPool\UiComponent\Model\Ui\Adminhtml;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;
use StudyPool\ServiceContract\Model\ResourceModel\StudyPoolSc\Collection;
use StudyPool\ServiceContract\Model\ResourceModel\StudyPoolSc\CollectionFactory;
use StudyPool\ServiceContract\Api\StudyPoolScRepositoryInterface;
use StudyPool\ServiceContract\Api\Data\StudyPoolScInterface;
use StudyPool\ServiceContract\Api\Data\StudyPoolScInterfaceFactory;

/**
 * Class DataProvider
 *
 * @package StudyPool\UiComponent\Model\Ui\Adminhtml
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    private $loadedData;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var StudyPoolScRepositoryInterface
     */
    private $repository;

    /**
     * @var StudyPoolScInterfaceFactory
     */
    private $studyPoolScFactory;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     * @param StudyPoolScRepositoryInterface $repository
     * @param StudyPoolScInterfaceFactory $studyPoolScFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        StudyPoolScRepositoryInterface $repository,
        StudyPoolScInterfaceFactory $studyPoolScFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
        $this->repository = $repository;
        $this->studyPoolScFactory = $studyPoolScFactory;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        /** @var StudyPoolScInterface $studyPoolSc */
        $studyPoolSc = $this->getCurrentEntityItem();
        if ($studyPoolSc->getEntityId()) {
            $this->loadedData[$studyPoolSc->getEntityId()] = $studyPoolSc->getData();
        }

        return $this->loadedData;
    }

    /**
     * Get current benefit data
     *
     * @return StudyPoolScInterface
     */
    public function getCurrentEntityItem(): StudyPoolScInterface
    {
        $studyPoolSc = $this->studyPoolScFactory->create();
        $requestId = (int) $this->request->getParam($this->requestFieldName);
        if ($requestId) {
            $studyPoolSc = $this->repository->getById($requestId);
        }

        return $studyPoolSc;
    }
}
