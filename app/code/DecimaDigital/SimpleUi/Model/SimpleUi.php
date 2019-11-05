<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Model;

use Magento\Framework\Model\AbstractModel;
use DecimaDigital\SimpleUi\Api\Data\SimpleUiInterface;
use DecimaDigital\SimpleUi\Model\ResourceModel\SimpleUi as SimpleUiResource;

/**
 * Class SimpleUi
 *
 * @package DecimaDigital\SimpleUi\Model
 */
class SimpleUi extends AbstractModel implements SimpleUiInterface
{
    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(SimpleUiResource::class);
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

    /**
     * @inheritDoc
     */
    public function getIsActive(): int
    {
        return (int) $this->getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(int $isActive): void
    {
        $this->setData(self::IS_ACTIVE, $isActive);
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
    public function setCreatedAt(?string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }
}
