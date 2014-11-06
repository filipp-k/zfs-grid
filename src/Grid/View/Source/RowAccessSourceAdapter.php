<?php
namespace ZFS\Grid\View\Source;

/**
 * Class PropertyAccessSourceAdapter
 * @package ZFS\Grid\View\Source
 */
class RowAccessSourceAdapter extends AbstractSourceAdapter
{
    /**
     * @param mixed $source
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function get($source)
    {
        return $source;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions($options)
    {

    }
}
