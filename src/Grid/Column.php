<?php

namespace Grid;

/**
 * Class Column
 * @package Grid
 */
class Column
{
    /** @var  string */
    protected $name;

    /** @var  string */
    protected $title;

    /** @var  string */
    protected $tooltipText;

    /** @var  bool */
    protected $visible = true;

    /** @var  bool */
    protected $sortable = false;

    /** @var  string */
    protected $cssClass;

    /** @var  string */
    protected $cssStyle;

    /** @var  string */
    protected $dataPropertyName;

    /** @var  callable */
    protected $formatter;

    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        foreach ($options as $key => &$value) {
            if (method_exists($this, 'set' . $key)) {
                $this->{'set' . $key}($value);
            }
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

    /**
     * @return string
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * @param string $cssClass
     *
     * @return $this
     */
    public function setCssClass($cssClass)
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getCssStyle()
    {
        return $this->cssStyle;
    }

    /**
     * @param string $cssStyle
     *
     * @return $this
     */
    public function setCssStyle($cssStyle)
    {
        $this->cssStyle = $cssStyle;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataPropertyName()
    {
        return $this->dataPropertyName;
    }

    /**
     * @param string $dataPropertyName
     *
     * @return $this
     */
    public function setDataPropertyName($dataPropertyName)
    {
        $this->dataPropertyName = $dataPropertyName;

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
     * @param string $headerText
     *
     * @return $this
     */
    public function setTitle($headerText)
    {
        $this->title = $headerText;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSortable()
    {
        return $this->sortable;
    }

    /**
     * @param bool $sortable
     *
     * @return $this
     */
    public function setSortable($sortable)
    {
        $this->sortable = $sortable;

        return $this;
    }

    /**
     * @return string
     */
    public function getTooltipText()
    {
        return $this->tooltipText;
    }

    /**
     * @param string $tooltipText
     *
     * @return $this
     */
    public function setTooltipText($tooltipText)
    {
        $this->tooltipText = $tooltipText;

        return $this;
    }

    /**
     * @return bool
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     *
     * @return $this
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }
}
