<?php

declare(strict_types=1);

namespace Andrey\ServiceContract\Api\Data;

/**
 * Interface AndyScInterface
 *
 * @package Andrey\ServiceContract\Api\Data
 */
interface AndyScInterface
{
    public const ENTITY_ID = 'entity_id';
    public const NAME = 'name';
    public const DESCRIPTION = 'description';
    public const SOME_PRICE = 'some_price';
    public const IS_ACTIVE = 'is_active';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get entity id
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
     * Set some price
     *
     * @param float $status
     */
    public function setSomePrice(float $status): void;

    /**
     * Get some price
     *
     * @return float
     */
    public function getSomePrice(): float;

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

