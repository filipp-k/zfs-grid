<?php

namespace ZFS\Grid\View\Model\Column;

use ZFS\Grid\View\Model\Cell;
use ZFS\Grid\View\Model\Column;
use ZFS\Grid\View\Model\ModelFactory;

/**
 * Class Collection
 * @package ZFS\Grid\View\Model\Column
 */
class Collection extends \ArrayObject
{
    /**
     * @param $value
     *
     * @throws \InvalidArgumentException
     */
    protected function prepareValue(&$value)
    {
        if (is_array($value)) {
            $value = ModelFactory::createColumn($value);
        }

        if (!$value instanceof Column) {
            throw new \InvalidArgumentException('Value must be an array or instance of Column class');
        }
    }

    /**
     * @param mixed  $input
     * @param int    $flags
     * @param string $iterator_class
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($input = null, $flags = 0, $iterator_class = "ArrayIterator")
    {
        foreach ($input as &$column) {
            $this->prepareValue($column);
        }

        parent::__construct($input, $flags, $iterator_class);
    }

    /**
     * @param mixed $input
     *
     * @return array|void
     */
    public function exchangeArray($input)
    {
        foreach ($input as &$column) {
            $this->prepareValue($column);
        }
        parent::exchangeArray($input);
    }

    /**
     * @param array|Column $value
     *
     * @throws \InvalidArgumentException
     */
    public function append($value)
    {
        $this->prepareValue($value);
        parent::append($value);
    }

    /**
     * @param mixed $index
     *
     * @return mixed|void
     */
    public function offsetGet($index)
    {
        if (is_numeric($index)) {
            return parent::offsetGet($index);
        } elseif (is_string($index)) {
            foreach ($this as $column) {
                /** @var Column $column */
                if ($column->name == $index) {
                    return $column;
                }
            }
        }

        return null;
    }

    /**
     * @param int|string   $index
     * @param array|Column $newColumn
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($index, $newColumn)
    {
        if (is_array($newColumn)) {
            $newColumn = ModelFactory::createColumn($newColumn);
        }

        if (!$newColumn instanceof Column) {
            throw new \InvalidArgumentException('Value must be an array or instance of Column class');
        }

        if (is_numeric($index)) {
            parent::offsetSet($index, $newColumn);
        } elseif (is_string($index)) {
            foreach ($this as &$column) {
                /** @var Column $column */
                if ($column->name == $index) {
                    $column = $newColumn;
                }
            }
        }
    }

    /**
     * @param mixed $index
     *
     * @return bool
     */
    public function offsetExists($index)
    {
        if (is_numeric($index)) {
            return parent::offsetExists($index);
        } elseif (is_string($index)) {
            foreach ($this as $column) {
                /** @var Column $column */
                if ($column->name == $index) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return Cell\Collection|Cell[]
     */
    public function getCellPrototypes()
    {
        $cellPrototypes = new Cell\Collection();

        foreach ($this as $column) {
            /** @var Column $column */
            $cellModelPrototypes[$column->name] = $column->cellPrototype;
        }

        return $cellPrototypes;
    }

    /**
     *
     */
    public function uasort($cmp_function = null)
    {
        if (!$cmp_function) {
            $cmp_function = function ($a, $b) {
                /** @var Column $a */
                /** @var Column $b */

                if ($a->sortOrder == $b->sortOrder) {
                    return 0;
                } elseif ($a->sortOrder > $b->sortOrder) {
                    return 1;
                } else {
                    return -1;
                }
            };
        }

        parent::uasort($cmp_function);
    }
}
