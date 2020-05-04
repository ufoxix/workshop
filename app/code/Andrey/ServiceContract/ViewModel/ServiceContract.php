<?php

namespace Andrey\ServiceContract\ViewModel;

use Andrey\ServiceContract\Model\AndyScRepository;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class ServiceContract
 * @package Andrey\ServiceContract\ViewModel
 */
class ServiceContract implements ArgumentInterface
{
    /**
     * @var AndyScRepository
     */
    private $andyScRepository;

    /**
     * ServiceContract constructor.
     * @param AndyScRepository $andyScRepository
     */
    public function __construct(AndyScRepository $andyScRepository)
    {
        $this->andyScRepository = $andyScRepository;
    }

    /**
     * @return AndyScRepository
     */
    public function scRepository(): AndyScRepository
    {
        return $this->andyScRepository;
    }
}
