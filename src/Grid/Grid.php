<?php

namespace Grid;

use Zend\View\Model\ViewModel;

/**
 * Class Grid
 * @package Grid
 */
class Grid
{
    /** @var  string */
    protected $template;

    /** @var  \Traversable */
    protected $items;

    /** @var \ArrayObject */
    protected $columns;

    /**
     *
     */
    public function __construct()
    {
        $this->columns = new \ArrayObject();
    }

    /**
     * @return Column[]
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param Column[]|mixed $columns
     *
     * @throws \InvalidArgumentException
     */
    public function setColumns($columns)
    {
        foreach ($columns as &$value) {
            if (is_array($value)) {
                $value = new Column($value);
            }

            if (!($value instanceof Column)) {
                throw new \InvalidArgumentException('Array value must be an array or Column instance');
            }
        }

        $this->columns->exchangeArray($columns);
    }

    /**
     * @return \Traversable
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param \Traversable $dataSource
     *
     * @return $this
     */
    public function setItems($dataSource)
    {
        $this->items = $dataSource;

        return $this;
    }

    /**
     * @return ViewModel
     */
    public function getViewModel()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate($this->template);
        $viewModel->setVariable('grid', $this);

        return $viewModel;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @param mixed  $row
     * @param Column $column
     *
     * @return mixed
     */
    public function getValue($row, $column)
    {
        $value = null;

        if ($column->getDataPropertyName()) {
            $value = $row->{$column->getDataPropertyName()};
        }

        $closure = $column->getFormatter();
        if (is_callable($closure)) {
            $value = call_user_func($closure, $value, $row, $column, $this);
        }

        return $value;
    }
}
