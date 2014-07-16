<?php

namespace ZFS\Grid\View\Model;

/**
 * Class GridModel
 * @package ZFS\Grid\View\Model
 */
class GridModel
{
    /** @var  string */
    protected $id;

    /** @var  string */
    protected $css;

    /** @var  string */
    protected $style;

    /** @var array */
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
        usort(
            $this->columns,
            function ($a, $b) {
                /** @var ColumnModel $a */
                /** @var ColumnModel $b */
                return $a->getSortOrder() >= $b->getSortOrder();
            }
        );

        return $this->columns;
    }

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     * @return null|ColumnModel
     */
    public function getColumn($name)
    {
        if (array_key_exists($name, $this->columns)) {
            return $this->columns[$name];
        } else {
            throw new \InvalidArgumentException(
                'There is no column with name "' . $name .'"'
            );
        }
    }

    /**
     * @param ColumnModel[]|mixed $columns
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setColumns($columns)
    {
        $this->columns = [];

        foreach ($columns as &$value) {
            $this->addColumn($value);
        }

        return $this;
    }

    /**
     * @param ColumnModel|array $column
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function addColumn($column)
    {
        if (is_array($column)) {
            $column = new ColumnModel($column);
        }

        if ($column instanceof ColumnModel) {
            $this->columns[$column->getName()] = $column;
        } else {
            throw new \InvalidArgumentException(
                'Array value must be an correct array of column options or ColumnModel instance'
            );
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function removeColumn($name)
    {
        if (array_key_exists($name, $this->columns)) {
            unset ($this->columns[$name]);
        } else {
            throw new \InvalidArgumentException(
                'There is no column with name "' . $name .'"'
            );
        }

        return $this;
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
