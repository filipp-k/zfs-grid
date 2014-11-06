<?php

namespace ZFS\Grid\View\Model;

/**
 * Class ModelFactory
 * @package ZFS\Grid\View\Model
 */
class ModelFactory
{
    /**
     * @param array $data
     * @param Cell  $cellModelPrototype
     *
     * @return Cell
     */
    public static function createCell($data, $cellModelPrototype = null)
    {
        if ($cellModelPrototype instanceof Cell) {
            $cell = clone $cellModelPrototype;
        } else {
            $cell = new Cell();
        }
        $cell->setOptions($data);

        return $cell;
    }

    /**
     * @param array $data
     * @param Row   $rowPrototype
     *
     * @return Row
     */
    public static function createRow($data, $rowPrototype = null)
    {
        if ($rowPrototype instanceof Row) {
            $row = clone $rowPrototype;
        } else {
            $row = new Row();
        }
        $row->setOptions($data);

        return $row;
    }

    /**
     * @param array  $data
     * @param Column $columnPrototype
     *
     * @return Column
     */
    public static function createColumn($data, $columnPrototype = null)
    {
        if ($columnPrototype instanceof Column) {
            $column = clone $columnPrototype;
        } else {
            $column = new Column();
        }
        $column->setOptions($data);

        return $column;
    }
}
