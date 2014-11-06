<?php
namespace ZFS\Grid\View\Source;

/**
 * Class ArrayAccessSourceAdapter
 * @package ZFS\Grid\View\Source
 */
class ArrayAccessSourceAdapter extends AbstractSourceAdapter
{
    /** @var string */
    protected $key;

    /**
     * @param mixed $source
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function get($source)
    {
        if ($source instanceof \ArrayAccess) {
            return $source->offsetGet($this->key);
        } elseif (is_array($source)) {
            return $source[$this->key];
        } else {
            throw new \InvalidArgumentException(
                'Source must be an array or instance of class implemented \ArrayAccess interface'
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
        if (!isset($options['key'])) {
            throw new \InvalidArgumentException('Options for ArrayAccessSourceAdapter must have \'key\' option');
        }

        $this->key = $options['key'];

        return $this;
    }
}