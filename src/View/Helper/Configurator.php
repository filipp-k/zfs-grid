<?php

namespace ZFS\Grid\View\Helper;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\HelperPluginManager;

/**
 * Class Configurator
 * @package ZFS\Grid\View\Helper
 */
class Configurator implements ListenerAggregateInterface
{
    /**
     * @var array
     */
    protected $invokables = array(
        'grid'                => 'ZFS\Grid\View\Helper\Grid',
        'gridHeader'          => 'ZFS\Grid\View\Helper\GridHeader',
        'gridHeaderRow'       => 'ZFS\Grid\View\Helper\GridHeaderRow',
        'gridHeaderCell'      => 'ZFS\Grid\View\Helper\GridHeaderCell',
        'GridHeaderCellValue' => 'ZFS\Grid\View\Helper\GridHeaderCellValue',
        'gridBody'            => 'ZFS\Grid\View\Helper\GridBody',
        'gridBodyRow'         => 'ZFS\Grid\View\Helper\GridBodyRow',
        'gridBodyCell'        => 'ZFS\Grid\View\Helper\GridBodyCell',
        'GridBodyCellValue'   => 'ZFS\Grid\View\Helper\GridBodyCellValue',
        'gridFooter'          => 'ZFS\Grid\View\Helper\GridFooter',
        'gridFooterRow'       => 'ZFS\Grid\View\Helper\GridFooterRow',
        'gridFooterCell'      => 'ZFS\Grid\View\Helper\GridFooterCell',
        'GridFooterCellValue' => 'ZFS\Grid\View\Helper\GridFooterCellValue',
    );

    /**
     * @var array
     */
    protected $listeners = array();

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_BOOTSTRAP, array($this, 'onBootstrap'));
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @param MvcEvent $event
     */
    public function onBootstrap(MvcEvent $event)
    {
        /** @var HelperPluginManager $viewHelperManager */
        $viewHelperManager = $event->getApplication()->getServiceManager()->get('ViewHelperManager');

        foreach ($this->invokables as $name => $invokableClass) {
            $viewHelperManager->setInvokableClass($name, $invokableClass);
        }
    }
}
