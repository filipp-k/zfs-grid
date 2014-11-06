<?php
namespace ZFS\Grid\View\Source;

/**
 * Class PropertyAccessSourceAdapter
 * @package ZFS\Grid\View\Source
 */
class PropertyAccessSourceAdapter extends AbstractSourceAdapter
{
    /** @var string */
    protected $property;

    /**
     * @param mixed $source
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function get($source)
    {
        if (isset($source->{$this->property})) {
            return $source->{$this->property};
        } else {
            throw new \InvalidArgumentException(
                'Source does not have appropriate property: ' . $this->property
            );
        }
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        if (!isset($options['property'])) {
            throw new \InvalidArgumentException('Options for PropertyAccessSourceAdapter must have \'property\' option');
        }

        $this->property = $options['property'];

        return $this;
    }
}