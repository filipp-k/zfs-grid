<?php
namespace ZFS\Grid\View\Source;

/**
 * Class MethodAccessSourceAdapter
 * @package ZFS\Grid\View\Source
 */
class MethodAccessSourceAdapter extends AbstractSourceAdapter
{
    /** @var string */
    protected $method;

    /** @var array */
    protected $arguments;

    /**
     * @param mixed $source
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function get($source)
    {
        if (method_exists($source, $this->method)) {
            return call_user_func_array(array($source, $this->method), $this->arguments);
        } else {
            throw new \InvalidArgumentException(
                'Source does not have appropriate method: ' . $this->method
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
        if (!isset($options['method'])) {
            throw new \InvalidArgumentException('Options for MethodAccessSourceAdapter must have \'method\' option');
        }

        $this->method = $options['method'];
        $this->arguments = isset($options['arguments']) ? $options['arguments'] : array();

        return $this;
    }
}