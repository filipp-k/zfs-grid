<?php

namespace ZFS\Grid\View\Model;

class GridModel
{
    /** @var  string */
    protected $id;

    /** @var  string */
    protected $css;

    /** @var  string */
    protected $style;

    /** @var array  */
    protected $customs = array();

    /** @var  array */
    protected $rows;

    /** @var array */
    protected $columns = array();

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
     * @return ColumnModel[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param ColumnModel[]|mixed $columns
     *
     * @throws \InvalidArgumentException
     */
    public function setColumns($columns)
    {
        foreach ($columns as &$value) {
            if (is_array($value)) {
                $value = new ColumnModel($value);
            }

            if (!($value instanceof ColumnModel)) {
                throw new \InvalidArgumentException('Array value must be an array or ColumnModel instance');
            }
        }

        $this->columns = $columns;
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     *
     * @return $this
     */
    public function setRows($rows)
    {
        $this->rows = $rows;

        return $this;
    }
}
