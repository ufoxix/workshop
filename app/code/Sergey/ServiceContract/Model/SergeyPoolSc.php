<?php

declare(strict_types=1);

namespace Sergey\ServiceContract\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Registry;
use Sergey\ServiceContract\Api\Data\SergeyPoolScInterface;
use Magento\Framework\Model\AbstractModel;
use Sergey\ServiceContract\Model\ResourceModel\SergeyPoolScRes as SergeyPoolScResource;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;

/**
 * Class SergeyPoolSc
 *
 * @package SergeyPool\ServiceContract\Model
 */
class SergeyPoolSc extends AbstractModel implements SergeyPoolScInterface
{
    /**
     * @var DateTimeFactory
     */
    private $dateFactory;

    /**
     * StudyPoolSc constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param DateTimeFactory $dateFactory
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        DateTimeFactory $dateFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->dateFactory = $dateFactory;
    }

    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(SergeyPoolScResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId(): int
    {
        return (int) $this->getData(self::ENTITY_ID);
    }



    /**
     * @inheritDoc
     */
    public function getPrice(): float
    {
        return (float) $this->getData(self::PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setPrice(float $price=null): void
    {
        $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function isActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(bool $status): void
    {
        $this->setData(self::IS_ACTIVE, $status);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(?string $date): void
    {
        $this->setData(self::CREATED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(?string $date): void
    {
        $this->setData(self::UPDATED_AT, $date);
    }

    /**
     * @inheritDoc
     */
    public function getFullDescription(): string
    {
        return (string) $this->getData(self::FULL_DESC);
    }

    /**
     * @inheritDoc
     */
    public function setFullDescription(string $desc): void
    {
        $this->setData(self::FULL_DESC, $desc);
    }

    /**
     * @inheritDoc
     */
    public function beforeSave(): SergeyPoolSc
    {
        parent::beforeSave();

        $currentDate = $this->dateFactory->create()->gmtDate();
        if (!$this->getCreatedAt()) {
            $this->setCreatedAt($currentDate);
        }

        return $this;
    }
}
