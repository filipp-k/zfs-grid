<?php

namespace ZFS\Grid\View\Model;

use Zend\Filter\Word\UnderscoreToCamelCase;

/**
 * Class ColumnModel
 * @package ZFS\Grid\View\Model
 */
class ColumnModel
{
    const SORTED_NONE = '';
    const SORTED_ASC  = 'asc';
    const SORTED_DESC = 'desc';

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
    protected $cellFormatter;

    /** @var  callable */
    protected $titleFormatter;

    /** @var  string */
    protected $sorted = self::SORTED_NONE;

    /** @var  int */
    protected $sortOrder = 0;

    /** @var  array */
    protected $customs;

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        $utc = new UnderscoreToCamelCase();
        foreach ($options as $key => &$value) {
            $key        = $utc->filter($key);
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
    public function getCellFormatter()
    {
        return $this->cellFormatter;
    }

    /**
     * @param callable $cellFormatter
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setCellFormatter($cellFormatter)
    {
        if (is_callable($cellFormatter)) {
            $this->cellFormatter = $cellFormatter;
        } else {
            throw new \InvalidArgumentException('Cell formatter must be a callable object');
        }

        return $this;
    }

    /**
     * @param callable $titleFormatter
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setTitleFormatter($titleFormatter)
    {
        if (is_callable($titleFormatter)) {
            $this->titleFormatter = $titleFormatter;
        } else {
            throw new \InvalidArgumentException('Title formatter must be a callable object');
        }

        return $this;
    }

    /**
     * @return callable
     */
    public function getTitleFormatter()
    {
        return $this->titleFormatter;
    }

    /**
     * @param string $sorted
     *
     * @return $this
     */
    public function setSorted($sorted)
    {
        $this->sorted = $sorted;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSorted()
    {
        return $this->sorted;
    }

    /**
     * @param int $sortOrder
     *
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }
}
