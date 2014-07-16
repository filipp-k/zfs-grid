<?php

namespace ZFS\Grid\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZFS\Grid\View\Model\ColumnModel;

/**
 * Class GridBodyCell
 * @package ZFS\Grid\View\Helper
 */
class GridBodyCell extends AbstractHelper
{
    /**
     * @param mixed       $row
     * @param ColumnModel $column
     *
     * @return string
     */
    public function __invoke($row, ColumnModel $column)
    {
        return '<td>' . $this->getView()->gridBodyCellValue($row, $column) . '</td>';
    }
}
