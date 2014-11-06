<?php
namespace ZFS\Grid\View\Source;

/**
 * Class CallbackSourceAdapter
 * @package ZFS\Grid\View\Source
 */
class CallbackSourceAdapter extends AbstractSourceAdapter
{
    /** @var string */
    protected $callback;

    /**
     * @param mixed $source
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function get($source)
    {
        if (is_callable($this->callback)) {
            return call_user_func($this->callback, $source);
        } else {
            throw new \InvalidArgumentException(
                'CallbackSourceAdapter has not a callback'
            );
        }
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        if (!isset($options['callback'])) {
            throw new \InvalidArgumentException('Options for CallbackSourceAdapter must have \'callback\' option');
        } elseif (!is_callable($options['callback'])){
            throw new \InvalidArgumentException('\'callback\' option is not a callable');
        }

        $this->callback = $options['callback'];

        return $this;
    }
}