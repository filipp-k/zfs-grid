<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

/**
 * Class GridRowValue
 * @package ZFS\Grid\View\Helper
 */
class GridRowValue extends AbstractHelper
{
    /**
     * @param mixed       $row
     * @param ColumnModel $column
     *
     * @return mixed|null
     */
    public function __invoke($row, ColumnModel $column)
    {
        $value = null;

        if ($column->getFieldName()) {
            if (is_array($row) && isset($row[$column->getFieldName()])) {
                $value = $row[$column->getFieldName()];
            } elseif (isset($row->{$column->getFieldName()})) {
                $value = $row->{$column->getFieldName()};
            }
        }

        $closure = $column->getFormatter();
        if (is_callable($closure)) {
            $value = call_user_func($closure, $value, $row, $column);
        }

        return $value;
    }
}
