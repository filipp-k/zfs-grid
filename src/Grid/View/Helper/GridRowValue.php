<?php
/**
 * Created by PhpStorm.
 * User: Qoma
 * Date: 10/06/14
 * Time: 13:56
 */

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

class GridRowValue  extends AbstractHelper
{
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
