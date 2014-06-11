<?php

namespace ZFS\Grid\View\Model;

/**
 * Class ColumnModel
 * @package ZFS\Grid\View\Model
 */
class ColumnModel extends \stdClass
{
    /** @var  string */
    protected $name;

    /** @var  string */
    protected $title;

    /** @var  string */
    protected $id;

    /** @var  string */
    protected $css;

    /** @var  string */
    protected $style;

    /** @var  string */
    protected $fieldName;

    /** @var  callable */
    protected $formatter;

    /** @var  array */
    protected $customs;

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        foreach ($options as $key => &$value) {
            $this->$key = $value;
        }
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, 'get' . $key)) {
            return $this->{'get' . $key}();
        } else {
            return $this->customs[strtolower($key)];
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        if (method_exists($this, 'set' . $key)) {
            $this->{'set' . $key}($value);
        } else {
            $this->customs[strtolower($key)] = $value;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $css
     *
     * @return $this
     */
    public function setCss($css)
    {
        $this->css = $css;

        return $this;
    }

    /**
     * @return string
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * @param string $style
     *
     * @return $this
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param string $fieldName
     *
     * @return $this
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @return callable
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param callable $cellConstructCallback
     *
     * @return $this
     */
    public function setFormatter($cellConstructCallback)
    {
        $this->formatter = $cellConstructCallback;

        return $this;
    }
}
