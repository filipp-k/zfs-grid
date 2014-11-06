<?php
namespace ZFS\Grid\View\Model;

use Zend\Filter\FilterChain;

/**
 * Class AbstractModel
 *
 * @property callable formatter
 *
 * @package ZFS\Grid\View\Model
 */
abstract class AbstractModel
{
    /** @var bool  */
    protected $formatted = false;

    /** @var array */
    protected $methodNameFilterOptions = array(
        'filters' => array(
            array(
                'name' => 'WordUnderscoreToCamelCase'
            ),
            array(
                'name' => 'WordDashToCamelCase'
            )
        )
    );

    /** @var FilterChain */
    protected $methodNameFilter;

    /** @var array */
    protected $data = array();

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        $this->setOptions($options);
    }

    /**
     * @param callable $formatter
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    protected function setFormatter($formatter)
    {
        if (is_callable($formatter)) {
            $this->data('formatter', $formatter);
        } else {
            throw new \InvalidArgumentException('Cell formatter must be a callable object');
        }

        return $this;
    }

    /**
     * @param bool $force
     */
    public function format($force = false)
    {
        if ($this->formatter) {
            if (!$this->formatted || $force) {
                call_user_func($this->formatter, $this);
                $this->formatted = true;
            }
        }
    }

    /**
     * @return FilterChain
     */
    protected function getMethodNameFilter()
    {
        if (!$this->methodNameFilter) {
            $this->methodNameFilter = new FilterChain($this->methodNameFilterOptions);
        }

        return $this->methodNameFilter;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    protected function setOptions(&$options)
    {
        foreach ($options as $key => &$value) {
            $this->$key = $value;
        }

        return $this;
    }

    /**
     * @param string $key,...
     *
     * @return null|mixed
     */
    protected function data($key)
    {
        if (func_num_args() == 1) { // get
            return isset($this->data[$key]) ? $this->data[$key] : null;
        } else {                    // set
            $this->data[$key] = func_get_arg(1);

            return $this;
        }
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function __get($key)
    {
        //

        $methodName = 'get' . $key;
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }

        $methodName = 'get' . $this->getMethodNameFilter()->filter($key);
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }

        return $this->data($key);
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function __set($key, $value)
    {
        $methodName = 'set' . $key;
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);

            return;
        }

        $methodName = 'set' . $this->getMethodNameFilter()->filter($key);
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);

            return;
        }

        $this->data($key, $value);

        return;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        if (isset($this->data[$key])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $key
     */
    public function __unset($key)
    {
        if (isset($this->data[$key])) {
            unset ($this->data[$key]);
        }
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        $this->format();

        $attributes = $this->data;
        unset ($attributes['formatter']);

        return $attributes;
    }
}
