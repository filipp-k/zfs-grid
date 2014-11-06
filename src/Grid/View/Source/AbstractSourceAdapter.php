<?php
namespace ZFS\Grid\View\Source;

/**
 * Class AbstractSourceAdapter
 * @package ZFS\Grid\View\Source
 */
abstract class AbstractSourceAdapter
{
    /**
     * @param mixed $source
     * @return mixed
     */
    abstract public function get($source);

    /**
     * @param array $options
     * @return $this
     */
    abstract public function setOptions($options);
}
