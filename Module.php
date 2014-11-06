<?php

namespace ZFS\Grid;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @package ZFS\Grid
 */
class Module implements ConfigProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/cfg/module.cfg.php';
    }
}
