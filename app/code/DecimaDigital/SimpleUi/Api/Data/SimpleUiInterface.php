<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace DecimaDigital\SimpleUi\Api\Data;

/**
 * Interface SimpleUiInterface
 *
 * @package DecimaDigital\SimpleUi\Api\Data
 */
interface SimpleUiInterface
{
    public const ENTITY_ID = 'entity_id';
    public const NAME = 'name';
    public const DESCRIPTION = 'description';
    public const IS_ACTIVE = 'is_active';
    public const CREATED_AT = 'created_at';

    /**
     * Get id
     *
     * @return int
     */
    public function getEntityId(): int;

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Set name
     *
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription(string $description): void;

    /**
     * Get is active
     *
     * @return int
     */
    public function getIsActive(): int;

    /**
     * Set is active
     *
     * @param int $isActive
     */
    public function setIsActive(int $isActive): void;

    /**
     * Get created at
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set created at
     *
     * @param string|null $createdAt
     */
    public function setCreatedAt(?string $createdAt): void;
}
