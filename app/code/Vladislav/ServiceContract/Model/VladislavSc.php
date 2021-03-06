<?php

declare(strict_types=1);

namespace Vladislav\ServiceContract\Model;

use Magento\Framework\Model\AbstractModel;
use Vladislav\ServiceContract\Api\Data\VladislavScInterface;
use Vladislav\ServiceContract\Model\ResourceModel\VladislavSc as VladislavScResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\DateTimeFactory;

/**
 * Class AndySc
 *
 * @package Vladislav\ServiceContract\Model
 */

class VladislavSc extends AbstractModel implements VladislavScInterface
{
    /**
     * @var DateTimeFactory
     */

    private $dateFactory;

    /**
     * VladislavSc constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param DateTimeFactory $dateFactory
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry,DateTimeFactory $dateFactory,AbstractResource $resource = null,AbstractDb $resourceCollection = null,array $data = [])
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->dateFactory = $dateFactory;
    }

    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */

    public function _construct(): void
    {
        $this->init(VladislavScResource::class);
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

    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */

    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */

    public function getDescription(): string
    {
        return (string) $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */

    public function setDescription(string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

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

    public function getSomePrice():float
    {
        return $this->getData(self::SOME_PRICE);
    }

    /**
     * @inheritDoc
     */

    public function setSomePrice(float $date): void
    {
        $this->setData(self::SOME_PRICE, $date);
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

    public function setCreatedAt(?string $date): void
    {
        $this->setData(self::CREATED_AT, $date);
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

    public function setUpdatedAt(?string $date): void
    {
        $this->setData(self::UPDATED_AT, $date);
    }

    /**
     * @inheritDoc
     */

    public function beforeSave(): VladislavSc
    {
        parent::beforeSave();

        $currentDate = $this->dateFactory->create()->gmtDate();
        if (!$this->getCreatedAt()) {
            $this->setCreatedAt($currentDate);
        }

        return $this;
    }
}
