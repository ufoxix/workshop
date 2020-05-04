<?php

declare(strict_types=1);

namespace Sergey\ServiceContract\Api\Data;

/**
 * Interface SergeyPoolScInterface
 *
 * @package SergeyServiceContract\Api\Data
 */
interface SergeyPoolScInterface
{
    public const ENTITY_ID = 'entity_id';
    public const NAME = 'name';
    public const FULL_DESC = 'full_description';
    public const IS_ACTIVE = 'is_active';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const PRICE = 'price';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getEntityId(): int;

    /**
     * Get price
     *
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * Set price
     *
     * @param float|null $price
     */
    public function setPrice(?float $price): void;

    /**
     * Get description
     *
     * @return string
     */
    public function getFullDescription(): string;

    /**
     * Set description
     *
     * @param string $description
     */
    public function setFullDescription(string $description): void;

    /**
     * Check active status
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Set active status
     *
     * @param bool $status
     */
    public function setIsActive(bool $status): void;

    /**
     * Get created at
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set created at
     *
     * @param string|null $date
     */
    public function setCreatedAt(?string $date): void;
    /**
     * Get updated at
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set updated at
     *
     * @param string|null $date
     */
    public function setUpdatedAt(?string $date): void;
}
