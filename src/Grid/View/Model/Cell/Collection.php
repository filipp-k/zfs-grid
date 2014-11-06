<?php

namespace ZFS\Grid\View\Model\Cell;

use ZFS\Grid\View\Model\Cell;
use ZFS\Grid\View\Model\ModelFactory;

/**
 * Class Collection
 * @package ZFS\Grid\View\Model\Cell
 */
class Collection extends \ArrayObject
{
    /**
     * @param array|Cell $value
     *
     * @throws \InvalidArgumentException
     */
    public function append($value)
    {
        if (is_array($value)) {
            $value = ModelFactory::createCell($value);
        }

        if (!$value instanceof Cell) {
            throw new \InvalidArgumentException('Value must be an array or instance of Cell class');
        }

        parent::append($value);
    }

    /**
     * @param mixed      $index
     * @param array|Cell $cell
     *
     * @throws \InvalidArgumentException
     */
    public function offsetSet($index, $cell)
    {
        if (is_array($cell)) {
            $cell = ModelFactory::createColumn($cell);
        }

        if (!$cell instanceof Cell) {
            throw new \InvalidArgumentException('Value must be an array or instance of CEll class');
        }

        parent::offsetSet($index, $cell);
    }
}
